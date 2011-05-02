<?php

class modelgetmenu extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function isinusermenu($xidmenu){
        $xStr = "SELECT " .
                "idx," .
                "iduser," .
                "idmenu" .
                " FROM usermenu  WHERE iduser = '" . $this->session->userdata('idpegawai') . "' and idmenu = '".$xidmenu."'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return  !empty ($row);
    }

    function getListmenu($xIdKomponen, $xParent='') {
        if (!empty($xParent)) {
            $xParent = " and parentmenu = '" . $xParent . "'";
        } else {
            $xParent = " and parentmenu = '0'";
        }

        $xSearch = "Where  idkomponen ='" . $xIdKomponen . "'" . $xParent;

        $xStr = "SELECT " .
                "idmenu," .
                "nmmenu," .
                "tipemenu," .
                "idkomponen," .
                "iduser," .
                "parentmenu," .
                "urlci" .
                " FROM menu $xSearch order by idmenu  ";

        $query = $this->db->query($xStr);
        return $query;
    }

    function GetChild($xQuery, $xIsView=false) {

        $xBufResult = "";
        if (!empty($xQuery)) {

            foreach ($xQuery->result() as $row) {
                $xRowUrl = $row->urlci;

                if (empty($xRowUrl)) {
                    $xRowUrl = 'admin/index/' . $row->idmenu;
                }
                if ($xIsView) {
                    $xChild = $this->GetChild($this->getListmenu('2', $row->idmenu), $xIsView);
                    if($this->isinusermenu($row->idmenu))
                    $xBufResult .= setlionclick('SetHtmlList(' . $row->idmenu . ');', $row->nmmenu, $xChild);
                } else {
                    $xChild = $this->GetChild($this->getListmenu('2', $row->idmenu));
                    if($this->isinusermenu($row->idmenu))
                    $xBufResult .= setli(site_url($xRowUrl), $row->nmmenu, $xChild);
                }

                //$xChild  = $this->GetChild($this->getListmenu('2',$row->idmenu));
                // $xBufResult .= setli(site_url($xRowUrl),$row->nmmenu,$xChild);
            }

            if (!empty($xBufResult))
                $xBufResult = setul('', $xBufResult);
        }
        return $xBufResult;
    }


    function getMenuSampingKiri($xIsView=false) {

        $xQuery = $this->getListmenu("3");
        $xBufResult = "";
        $this->load->helper('menu');
        $this->load->helper('url');
        foreach ($xQuery->result() as $row) {
            $xRowUrl = $row->urlci;
            if (empty($xRowUrl)) {
               // $xRowUrl = 'admin/index/' . $row->idmenu;
                 $xRowUrl = '#';
            }
            if ($xIsView) {
                $xBufResult .= setlionclick('SetHtmlList(' . $row->idmenu . ');', $row->nmmenu);
            } else {

                $xBufResult .= setli(site_url($xRowUrl), $row->nmmenu);
            }
            // $xBufResult .= setli(site_url($xRowUrl),$row->nmmenu);
        }
        $xBufResult = '<div>' . setul('menusamping', $xBufResult) . '</div> <br/>';
        return $xBufResult;
    }

    function getMenuSampingKiriView() {

        $xQuery = $this->getListmenu("35");
        $xBufResult = "";
        $this->load->helper('menu');
        $this->load->helper('url');
        foreach ($xQuery->result() as $row) {
            $xRowUrl = $row->urlci;
            if (empty($xRowUrl)) {
                $xRowUrl = 'admin/index/' . $row->idmenu;
            }
            $xBufResult .= setli(site_url($xRowUrl), $row->nmmenu);
        }
        $xBufResult = '' . setul('menusampingview', $xBufResult) . '';
        return $xBufResult;
    }

    function getMenuSampingKanan() {
//        $xQuery = $this->getListmenu("4");
//        $xBufResult = "";
//        $this->load->helper('menu');
//        $this->load->helper('url');
//        foreach ($xQuery->result() as $row) {
//            $xRowUrl = $row->urlci;
//            if (empty($xRowUrl)) {
//                $xRowUrl = 'admin/index/' . $row->idmenu;
//            }
//            $xBufResult .= setli(site_url($xRowUrl), $row->nmmenu);
//        }
//        $xBufResult = setul('menusamping', $xBufResult);
//        return $xBufResult;
        
        $this->load->helper('form');
        $this->load->helper('common');
        $xBufResult = '<div id="stylized" class="myform2">'.form_open_multipart('ctrreportingbug/inserttable',array('id'=>'form','name'=>'form')).
                       setForm2('edketeranganbug','Tuliskan Temuan Kesalahan,Saran, dsb',  form_textarea(getArrayObj('edketeranganbug','','230','10','200'))).
                       form_button('btSimpan','kirim','onclick="dosimpanreportingbug();"');
                       ;
                
        return $xBufResult."</div>";
       
    }

    function getMenuAtas($xIsView=false) {
        $xBufResult = "";
        $this->load->helper('menu');
        $this->load->helper('url');

        $xQuery = $this->getListmenu("2");
        foreach ($xQuery->result() as $row) {

            $xRowUrl = $row->urlci;
            if ($row->iduser == '0') {
                if (empty($xRowUrl)) {
                    //$xRowUrl = 'admin/index/' . $row->idmenu;
                    $xRowUrl = '#';
                }
            }

            if ($xIsView) {
                $xChild = $this->GetChild($this->getListmenu('2', $row->idmenu), $xIsView);
                if($this->isinusermenu($row->idmenu))
                  $xBufResult .= setlionclick('SetHtmlList(' . $row->idmenu . ');', $row->nmmenu, $xChild);
            } else {
                $xChild = $this->GetChild($this->getListmenu('2', $row->idmenu));
                if($this->isinusermenu($row->idmenu))
                $xBufResult .= setli(site_url($xRowUrl), $row->nmmenu, $xChild);
            }
        }
        //$xBufResult = setul('menuatas',$xBufResult);
        $xBufResult = setul('', $xBufResult);

        return $xBufResult;
    }

    function GetChildMenuForTree($xQuery, $xIsView=false) {

        $xBufResult = "";
        if (!empty($xQuery)) {

            foreach ($xQuery->result() as $row) {
                $xRowUrl = $row->urlci;

                if (empty($xRowUrl)) {
                    $xRowUrl = 'admin/index/' . $row->idmenu;
                }
                if ($xIsView) {
                    $xChild = $this->GetChildMenuForTree($this->getListmenu('2', $row->idmenu), $xIsView);
                    $xBufResult .= setlionclick('SetHtmlList(' . $row->idmenu . ');', $row->nmmenu, $xChild);
                } else {
                    $xChild = $this->GetChildMenuForTree($this->getListmenu('2', $row->idmenu));
                    $xBufResult .= setlitreechk($row->idmenu, $row->nmmenu, $xChild);
                }

                //$xChild  = $this->GetChild($this->getListmenu('2',$row->idmenu));
                // $xBufResult .= setli(site_url($xRowUrl),$row->nmmenu,$xChild);
            }

            if (!empty($xBufResult))
                $xBufResult = setultree ('', $xBufResult);
        }
        return $xBufResult;
    }

    function getMenuForTree($xIsView=false) {
        $xBufResult = "";
        $this->load->helper('menu');
        $this->load->helper('url');

        $xQuery = $this->getListmenu("2");
        foreach ($xQuery->result() as $row) {

            $xRowUrl = $row->urlci;
            if ($row->iduser == '0') {
                if (empty($xRowUrl)) {
                    $xRowUrl = 'admin/index/' . $row->idmenu;
                }
            }

            if ($xIsView) {
                $xChild = $this->GetChildMenuForTree($this->getListmenu('2', $row->idmenu), $xIsView);
                $xBufResult .= setlionclick('SetHtmlList(' . $row->idmenu . ');', $row->nmmenu, $xChild);
            } else {
                $xChild = $this->GetChildMenuForTree($this->getListmenu('2', $row->idmenu));
                $xBufResult .= setlitreechk($row->idmenu, $row->nmmenu, $xChild);
            }
        }
        //$xBufResult = setul('menuatas',$xBufResult);
        $xBufResult = setultree('id="tree"' , $xBufResult);

        return $xBufResult;
    }


    

    function SetViewPerpus($xContent,$xList,$xBuf,$xAddJs) {
        //$xShow = setviewdolphin($xMnHeader, $xContent, $xImageView, $xFooterMenu, $xFooter);
        $this->load->helper('common');
        $this->load->helper('html');

        if($xBuf=='login'){
           $this->session->sess_destroy();
           $xMenuKanan = '';
           $xMnHeader = '';
           $xUser ='';
        }
        $xUser = $this->session->userdata('nama');
        if(!empty ($xUser)){
           $xMenuKanan = $this->getMenuSampingKanan();
           $xMnHeader = $this->getMenuAtas();
           $xBufResult = $xContent . '</form></div> ' . $xList;
        } else
        {
          $xMenuKanan = '';
           $xMnHeader = '';
           if($xBuf=='login'){
            $xBufResult = $xContent . '</form></div> ' . $xList;
           } else {
            $xBufResult ='Mohon Maaf Session Server Anda Sudah HABIS, silahkan login untuk masuk ke sistem/klik link berikut <a href="'.base_url().'">Login</a>';
           }
           
        }
        

        $xShow = setviewperpus($xMnHeader, $xBufResult, '$xImageView', '$xMenuKiri', $xMenuKanan);
        $xecho = '<!doctype html>
              <html>
              <head>' .
                link_tag('resource/css/perpus.css') .
                link_tag('resource/css/frmlayout.css') .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/curvycorners.src.js"></script>' .
                '  <script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/jquery.js"></script>' .
                   '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/jquery.cycle.all.min.js"></script>' .
                           link_tag('resource/css/jqmenuatas.css') .
                           link_tag('resource/css/menusamping.css').
               '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxreportingbugsmall.js"></script>' .
               '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/jqmenuatas.js"></script>'.
                $xAddJs.
               ' 
                                <!--[if lte IE 7]>
                    <style type="text/css">
                      html .jqueryslidemenu{height: 1%;} /*Holly Hack for IE7 and below*/
                    </style>
                    <![endif]-->
                               <script type="text/javascript">
                                $(document).ready(function() {
                                 $(\'.slideshow\').cycle({
                                 fx: \'curtainX\' // choose your transition type, ex: curtainX,fade, scrollUp, shuffle, etc...
                                });
                               });
                              </script>
                          <script type="text/javascript">
    function initCorners() {
        var setting = {
            tl: { radius: 10 }, // top left
            tr: { radius: 10 }, // top right
            bl: { radius: 10 }, // bottom left
            br: { radius: 10 }, // bottom right
            antiAlias: true
        }

      //curvyCorners(setting, "div#isi");
//      curvyCorners(setting, "div#headermenu1");
//      curvyCorners(setting, "div#headermenu2");


     }
     addEvent(window, \'load\', initCorners);
//      $("#foo1").carouFredSel();
//    </script>


               </head>
                   <body>' .
                $xShow .
                '    </body>' .
                '  </html>';
        return $xecho;
    }

}

?>
