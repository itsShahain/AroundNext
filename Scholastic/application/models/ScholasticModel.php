<?php

class ScholasticModel extends CI_Model
{
  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  function AddAwaitApprovalTuple($Email, $Name, $ClassTeacher, $UserAgent, $UserIP)
  {
    $InsertData = array(
      "Email" => $Email,
      "Name" => $Name,
      "ClassTeacher" => $ClassTeacher,
      "UserAgent" => $UserAgent,
      "UserIP" => $UserIP
    );
    $this->db->insert("tblAwaitsApproval", $InsertData);
  }

  //Removed due to inefficiency, created an alternative

  // function RetrieveMailAddresses()
  // {
  //   $this->db->select('UEmail');
  //   $QData = $this->db->get('tblUsers');
  //   $QData = $QData->result();
  //   $JSONStr = "{";
  //   $JSONObjIndex = 0;
  //   foreach ($QData as $Row) {
  //     $JSONStr .= '"' . $JSONObjIndex . '":"' . $Row->UEmail . '",';
  //     $JSONObjIndex++;
  //   }
  //   $JSONStr = substr($JSONStr, 0, -1);
  //   $JSONStr .= "}";
  //   $FileHandle = fopen("application/AsyncRequestFiles/Emails.json", "w") or die("Unable to open file!");
  //   fputs($FileHandle, $JSONStr);
  //   fclose($FileHandle);
  // }

  function is_existing_name($Name)
  {
    $QData = $this->db->get_where('tblUsers', array('Name' => $Name));
    $NumRows = $QData->num_rows();
    return $NumRows;
  }

  function is_existing_email($Email)
  {
    $QData = $this->db->get_where('tblUsers', array('UEmail' => $Email));
    $NumRows = $QData->num_rows();
    return $NumRows;
  }

  function insert_event($Title, $Desc, $Image, $Date, $Email)
  {
    $Data = array(
      'Title' => $Title,
      'Details' => $Desc,
      'Date' => $Date,
      'Image' => $Image,
      'Hearts' => 0,
      'EEmail' => $Email
    );
    $this->db->insert('tblEvents', $Data);
  }

  function retrieve_events()
  {
    $QResult = $this->db->get('tblEvents');
    return $QResult;
  }
  function retrieve_blob($ID)
  {
    $Result = $this->db->get_where('tblEvents', array('EID' => $ID));
    return $Result->row();
  }

  function retrieve_name($Email)
  {
    $QResult = $this->db->get_where('tblUsers', array('UEmail' => $Email));
    $QResult = $QResult->row();
    return $QResult->Name;
  }

  function delete_old()
  {
    $SQLstr = "SELECT EID,Date FROM tblEvents";
    $QResult = $this->db->query($SQLstr);
    $QResult = $QResult->result();
    foreach ($QResult as $row) {
      $Date = $row->Date;
      $ID = $row->EID;
      if (strtotime($Date) < strtotime("-30 days")) {
        $this->db->delete('tblEvents', array('EID' => $ID));
      }
    }
  }

  function check_bookmark($ID, $Email)
  {
    $QResult = $this->db->get_where('tblUserBookmarks', array("BID" => $ID, "BEmail" => $Email));
    if ($QResult->num_rows()) {
      return "event-footer-ev-bk-active";
    } else {
      return "";
    }
  }

  function insert_bookmark($ID, $Email)
  {
    $QResult = $this->db->get_where('tblUserBookmarks', array("BID" => $ID, "BEmail" => $Email));
    if ($QResult->num_rows()) {
      $this->db->delete('tblUserBookmarks', array('BID' => $ID));
    } else {
      $InsertData = array(
        "BID" => $ID,
        "BEmail" => $Email
      );
      $this->db->insert("tblUserBookmarks", $InsertData);
    }
  }

  function retrieve_bookmarks($Email)
  {
    $SQLStr =  "SELECT * from tblUserBookmarks INNER JOIN tblEvents ON tblUserBookmarks.BID = tblEvents.EID WHERE BEmail = '" . $Email . "'";
    $QData = $this->db->query($SQLStr);
    return $QData;
  }

  function update_hearts($ID, $Delta)
  {
    $SQLStr = "UPDATE tblEvents SET Hearts = Hearts +" . $Delta . " WHERE EID = " . $ID;
    $this->db->query($SQLStr);
  }

  function realtime_hearts_update()
  {
    $this->db->select(array("EID", "Hearts"));
    $QData = $this->db->get('tblEvents');
    $QData = $QData->result();
    $JSONStr = "{";
    foreach ($QData as $Row) {
      $JSONStr .= '"' . $Row->EID . '":' . $Row->Hearts . ',';
    }
    $JSONStr = substr($JSONStr, 0, -1);
    $JSONStr .= "}";
    return $JSONStr;
  }



  function check_hearts($ID, $Email)
  {
    $QResult = $this->db->get_where('tblUserHearts', array("HID" => $ID, "HEmail" => $Email));
    if ($QResult->num_rows()) {
      return "event-footer-ev-hrt-active";
    } else {
      return "";
    }
  }

  function insert_heart($ID, $Email)
  {
    $QResult = $this->db->get_where('tblUserHearts', array("HID" => $ID, "HEmail" => $Email));
    if ($QResult->num_rows()) {
      $this->db->delete('tblUserHearts', array('HID' => $ID));
    } else {
      $InsertData = array(
        "HID" => $ID,
        "HEmail" => $Email
      );
      $this->db->insert("tblUserHearts", $InsertData);
    }
  }

  function get_max_current_update_max_seen($Email)
  {
    $SQLStr = "SELECT MAX(EID) AS MaxSeen FROM tblEvents";
    $QData = $this->db->query($SQLStr);
    $QData = $QData->row();
    $MaxSeen = $QData->MaxSeen;
    if ($MaxSeen) {
      $SQLStr = "UPDATE tblUserLastSeen SET LID = $MaxSeen WHERE LEmail = '$Email'";
      $this->db->query($SQLStr);
    }
  }

  function get_new_events_ns($Email)
  {
    $SQLStr = "SELECT MAX(EID) AS MaxNotSeen FROM tblEvents";
    $QData = $this->db->query($SQLStr);
    $QData = $QData->row();
    $MaxNotSeen = $QData->MaxNotSeen;
    $SQLStr = "SELECT MAX(LID) AS MaxSeen FROM tblUserLastSeen WHERE LEmail = '$Email'";
    $QData = $this->db->query($SQLStr);
    $QData = $QData->row();
    $MaxSeen =  $QData->MaxSeen;
    if ($MaxNotSeen > $MaxSeen) {
      $SQLStr = "SELECT Count(*) AS Num FROM tblEvents WHERE EID > $MaxSeen";
      $QData = $this->db->query($SQLStr);
      $QData = $QData->row();
      return $QData->Num;
    }
  }

  function get_search_events($SearchQ)
  {
    $SQLStr = "SELECT * from tblEvents where Title LIKE '%$SearchQ%' OR Details LIKE '%$SearchQ%'";
    $QData = $this->db->query($SQLStr);
    return $QData;
  }

  function get_page_new_events($Email)
  {
    $SQLStr = "SELECT MAX(EID) AS MaxNotSeen FROM tblEvents";
    $QData = $this->db->query($SQLStr);
    $QData = $QData->row();
    $MaxNotSeen = $QData->MaxNotSeen;
    $SQLStr = "SELECT MAX(LID) AS MaxSeen FROM tblUserLastSeen WHERE LEmail = '$Email'";
    $QData = $this->db->query($SQLStr);
    $QData = $QData->row();
    $MaxSeen =  $QData->MaxSeen;

    $SQLStr = "SELECT *  FROM tblEvents WHERE EID > $MaxSeen";
    $QData = $this->db->query($SQLStr);
    return $QData;
  }
}


// \(o_o)/
// (^-^*)
// (>_<)
// (≥o≤)