<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Scholastic extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('form_validation');
    $this->load->model('ScholasticModel');
    $this->load->helper('html');
    $this->load->library('session');
  }

  public function index()
  {
    $this->load->view('Bonjour');
  }

  public function sign_up()
  {
    $Name = html_escape($this->security->xss_clean($this->input->post("name")));
    $Email = html_escape($this->security->xss_clean($this->input->post("email")));
    $ClassTeacher = html_escape($this->security->xss_clean($this->input->post("cteacher")));
    $UserAgent = $this->input->server("HTTP_USER_AGENT");
    $UserIP = $this->input->server("REMOTE_ADDR");
    $this->ScholasticModel->AddAwaitApprovalTuple($Email, $Name, $ClassTeacher, $UserAgent, $UserIP);

    $this->load->view("Success");
  }

  public function sign_in()
  {
    $this->load->view("SignIn");
  }
  public function validate_sign_in()
  {

    $this->form_validation->set_rules('name', 'Name', 'required|max_length[20]|callback_name_check');
    $this->form_validation->set_rules('email', 'Email', 'required|max_length[20]|callback_email_check');
    if ($this->form_validation->run() == FALSE) {
      $this->load->view('SignIn');
    } else {
      $this->session->set_userdata("Email", $this->input->post("email"));
      $this->session->set_userdata("Name", $this->input->post("name"));
      header("Location:http://localhost/Shahain/Scholastic/index.php/Scholastic/home");
    }
  }

  function name_check($Name)
  {
    $Result = $this->ScholasticModel->is_existing_name($Name);
    if ($Result) {
      return TRUE;
    } else {
      $this->form_validation->set_message('name_check', "That Name doesn't exist.");
      return FALSE;
    }
  }
  function email_check($Email)
  {
    $Result = $this->ScholasticModel->is_existing_email($Email);
    if ($Result) {
      return TRUE;
    } else {
      $this->form_validation->set_message('email_check', "That Email doesn't exist.");
      return FALSE;
    }
  }

  function realtime_email_check() {
    $Result = $this->ScholasticModel->is_existing_email($this->input->post("check_mail"));
    echo $Result;
  }

  function home()
  {
    if ($this->session->Email) {
      $this->ScholasticModel->delete_old();
      $this->get_new_events();
      $this->ScholasticModel->get_max_current_update_max_seen($this->session->Email);
      $Events = array();
      $ENum = 0;
      $QResult = $this->ScholasticModel->retrieve_events();
      $NumRows = $QResult->num_rows();
      $QResult = $QResult->result();
      $Err = '
      <div class="error-cont">
        <img src="http://localhost/Shahain/Scholastic/application/assets/images/kao_1.png" alt="">
        <p>Seems like no one has posted any events... Be the first one to do so!</p>
      </div>';
      if ($NumRows) {
        foreach ($QResult as $row) {
          $ClassBk = $this->ScholasticModel->check_bookmark($row->EID, $this->session->Email);
          $ClassHrt = $this->ScholasticModel->check_hearts($row->EID, $this->session->Email);
          $ENum++;
          $EachPost = 
          '<div class="test-post" id="test-post">
            <div class="event-heading-cont">
              <span class="number">#' . $ENum . '</span>
              <h2>' . $row->Title . '</h2>
              <span class="dot"></span><span class="name">' . $this->get_name($row->EEmail) . '</span><span class="date"><i class="fas fa-calendar-alt"></i>' . $row->Date . '</span>
            </div>
            <span class="date"><i class="fas fa-calendar-alt"></i>' . $row->Date . '</span>
            <div class="event-image-container" style="background-image:url(http://localhost/Shahain/Scholastic/index.php/Scholastic/get_image/' . $row->EID . ')"></div>
            <p class="event-description">' . $row->Details . '</p>
            <div class="event-footer ' . $ClassBk . ' ' . $ClassHrt . '"><i class="fas fa-bookmark ev-bk" title="' . $row->EID . '"></i><span class="heart-number" >' . $row->Hearts . '</span><i class="fas fa-heart ev-hrt" title="' . $row->EID . '"></i></div>
          </div>';

          array_push($Events, $EachPost);
        }
      } else {
        array_push($Events, $Err);
      }


      $this->load->view("Home", array("Events" => $Events, "whereami" => "Home", "whoami" => $this->session->Name));
    } else {
      header("Location:http://localhost/Shahain/Scholastic/index.php/Scholastic/");
    }
  }

  function bookmarks()
  {
    if ($this->session->Email) {
      $Events = array();
      $ENum = 0;
      $QResult = $this->ScholasticModel->retrieve_bookmarks($this->session->Email);
      $NumRows = $QResult->num_rows();
      $QResult = $QResult->result();
      $Err = 
      '<div class="error-cont">
        <img src="http://localhost/Shahain/Scholastic/application/assets/images/kao_2.png" alt="">
        <p>You don\'t seem to have any bookmarks. Bookmark a few to see them here.</p>
      </div>';
      if ($NumRows) {
        foreach ($QResult as $row) {
          $ENum++;
          $EachPost = 
          '<div class="test-post">
            <div class="event-heading-cont">
              <span class="number">#' . $ENum . '</span>
              <h2>' . $row->Title . '</h2>
              <span class="dot"></span><span class="name">' . $this->get_name($row->EEmail) . '</span><span class="date"><i class="fas fa-calendar-alt"></i>' . $row->Date . '</span>
            </div>
            <span class="date"><i class="fas fa-calendar-alt"></i>' . $row->Date . '</span>
            <div class="event-image-container" style="background-image:url(http://localhost/Shahain/Scholastic/index.php/Scholastic/get_image/' . $row->EID . ')"></div>
            <p class="event-description">' . $row->Details . '</p>
            <div class="event-footer" style="visibility:hidden;"><i class="fas fa-bookmark ev-bk" title="' . $row->EID . '"></i><span class="heart-number" >' . $row->Hearts . '</span><i class="fas fa-heart ev-hrt" title="' . $row->EID . '"></i></div>
          </div>';

          array_push($Events, $EachPost);
        }
      } else {
        array_push($Events, $Err);
      }


      $this->load->view("Home", array("Events" => $Events, "whereami" => "Bookmarks", "whoami" => $this->session->Name));
    } else {
      header("Location:http://localhost/Shahain/Scholastic/index.php/Scholastic/");
    }
  }


  function get_image($ID)
  {
    $Img = $this->ScholasticModel->retrieve_blob($ID);
    echo $Img->Image;
  }

  function get_name($Email)
  {
    $Name = $this->ScholasticModel->retrieve_name($Email);
    return $Name;
  }

  function create()
  {
    $this->load->view("Create");
  }

  function create_event()
  {
    $Title = $this->input->post("title");
    $Desc = $this->input->post("desc");
    $Date = $this->input->post("date");
    $TmpName =  $_FILES["file"]["tmp_name"];
    $ImgFileHandle = fopen($TmpName, "r");
    $Image = fread($ImgFileHandle, filesize($TmpName));
    fclose($ImgFileHandle);
    $Email = $this->session->Email;
    $this->ScholasticModel->insert_event($Title, $Desc, $Image, $Date, $Email);
    header("Location:http://localhost/Shahain/Scholastic/index.php/Scholastic/home");
  }

  function bookmark()
  {
    $ID = $this->input->post("ID");
    $this->ScholasticModel->insert_bookmark($ID, $this->session->Email);
  }

  function heart()
  {
    $Delta = $this->input->post("delta");
    $ID = $this->input->post("ID");
    $this->ScholasticModel->update_hearts($ID, $Delta);
    $this->ScholasticModel->insert_heart($ID, $this->session->Email);
  }

  function realtime_hearts()
  {
    $JSONStr = $this->ScholasticModel->realtime_hearts_update();
    echo $JSONStr;
  }

  function get_new_events()
  {
    $Num = $this->ScholasticModel->get_new_events_ns($this->session->Email);
    echo $Num;
  }

  function new_events()
  {
    if ($this->session->Email) {
      $Events = array();
      $ENum = 0;
      $QResult = $this->ScholasticModel->get_page_new_events($this->session->Email);
      $NumRows = $QResult->num_rows();
      $QResult = $QResult->result();
      $Err = 
      '<div class="error-cont">
        <img src="http://localhost/Shahain/Scholastic/application/assets/images/kao_4.png" alt="">
        <p>There are no new events here. If someone posts an event while you are online we will be sure to notify you here.</p>
      </div>';
      if ($NumRows) {
        foreach ($QResult as $row) {
          $ENum++;
          $EachPost = 
          '<div class="test-post">
            <div class="event-heading-cont">
              <span class="number">#' . $ENum . '</span>
              <h2>' . $row->Title . '</h2>
              <span class="dot"></span><span class="name">' . $this->get_name($row->EEmail) . '</span><span class="date"><i class="fas fa-calendar-alt"></i>' . $row->Date . '</span>
            </div>
            <span class="date"><i class="fas fa-calendar-alt"></i>' . $row->Date . '</span>
            <div class="event-image-container" style="background-image:url(http://localhost/Shahain/Scholastic/index.php/Scholastic/get_image/' . $row->EID . ')"></div>
            <p class="event-description">' . $row->Details . '</p>
            <div class="event-footer" style="visibility:hidden;"><i class="fas fa-bookmark ev-bk" title="' . $row->EID . '"></i><span class="heart-number" >' . $row->Hearts . '</span><i class="fas fa-heart ev-hrt" title="' . $row->EID . '"></i></div>
          </div>';

          array_push($Events, $EachPost);
        }
      } else {
        array_push($Events, $Err);
      }


      $this->load->view("Home", array("Events" => $Events, "whereami" => "New Events", "whoami" => $this->session->Name));
    } else {
      header("Location:http://localhost/Shahain/Scholastic/index.php/Scholastic/");
    }
  }


  function search($SearchQ = "`~`")
  {
    if ($this->session->Email) {
      $Events = array();
      $ENum = 0;
      $QResult = $this->ScholasticModel->get_search_events($SearchQ);
      $NumRows = $QResult->num_rows();
      $QResult = $QResult->result();
      $Err = 
      '<div class="error-cont">
        <img src="http://localhost/Shahain/Scholastic/application/assets/images/kao_3.png" alt="">
        <p>Looks like your search didn\'t match any events. Try searching again.</p>
      </div>';
      if ($NumRows) {
        foreach ($QResult as $row) {
          $ENum++;
          $EachPost = 
          '<div class="test-post">
            <div class="event-heading-cont">
              <span class="number">#' . $ENum . '</span>
              <h2>' . $row->Title . '</h2>
              <span class="dot"></span><span class="name">' . $this->get_name($row->EEmail) . '</span><span class="date"><i class="fas fa-calendar-alt"></i>' . $row->Date . '</span>
            </div>
            <span class="date"><i class="fas fa-calendar-alt"></i>' . $row->Date . '</span>
            <div class="event-image-container" style="background-image:url(http://localhost/Shahain/Scholastic/index.php/Scholastic/get_image/' . $row->EID . ')"></div>
            <p class="event-description">' . $row->Details . '</p>
            <div class="event-footer" style="visibility:hidden;"><i class="fas fa-bookmark ev-bk" title="' . $row->EID . '"></i><span class="heart-number" >' . $row->Hearts . '</span><i class="fas fa-heart ev-hrt" title="' . $row->EID . '"></i></div>
          </div>';

          array_push($Events, $EachPost);
        }
      } else {
        array_push($Events, $Err);
      }


      $this->load->view("Home", array("Events" => $Events, "whereami" => "Search", "whoami" => $this->session->Name));
    } else {
      header("Location:http://localhost/Shahain/Scholastic/index.php/Scholastic/");
    }
  }
}
