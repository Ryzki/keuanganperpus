<?php

class modelgetmenu extends CI_Model {

    function __construct() {
        parent::__construct();
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
                    $xBufResult .= setlionclick('SetHtmlList(' . $row->idmenu . ');', $row->nmmenu, $xChild);
                } else {
                    $xChild = $this->GetChild($this->getListmenu('2', $row->idmenu));
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
                $xRowUrl = 'admin/index/' . $row->idmenu;
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
        $xQuery = $this->getListmenu("4");
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
        $xBufResult = setul('menusamping', $xBufResult);
        return $xBufResult;
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
                    $xRowUrl = 'admin/index/' . $row->idmenu;
                }
            }

            if ($xIsView) {
                $xChild = $this->GetChild($this->getListmenu('2', $row->idmenu), $xIsView);
                $xBufResult .= setlionclick('SetHtmlList(' . $row->idmenu . ');', $row->nmmenu, $xChild);
            } else {
                $xChild = $this->GetChild($this->getListmenu('2', $row->idmenu));
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


    /*     * ************* View Control ********************************* */

    
    
    function setAnchor($isAdmin, $idmenu, $link, $exception="") {
        if ($isAdmin) {
            $xpage = 'admin';
        } else {
            $xpage = 'dolphin';
        }

        if (!empty($exception))
            $xpage = $exception;

        return '<a href="' . site_url('/' . $xpage . '/index/' . $idmenu) . '" >' . $link . ' </a>';
    }

    function setLinkMenu($isAdmin, $image, $idmenu, $textmenu) {
        $ximage = '<img src="' . base_url() . 'resource/png/' . $image . '" width="80px" height="80px"/>';

        //if (($isAdmin) && ($idmenu == '10'))
        if ($idmenu == '10')
            return '  <div id="menuitem">' . $this->setanchor($isAdmin, '0', $ximage, 'ctrproduk') . $this->setanchor($isAdmin, $idmenu, $textmenu, 'ctrproduk') . '</div>';
        else //if (($isAdmin) && ($idmenu == '13'))
            if ($idmenu == '13')
            return '  <div id="menuitem">' . $this->setanchor($isAdmin, $idmenu, $ximage, 'ctrcontactus') . $this->setanchor($isAdmin, $idmenu, $textmenu, 'ctrcontactus') . '</div>';
        else
            return '  <div id="menuitem">' . $this->setanchor($isAdmin, $idmenu, $ximage) . $this->setanchor($isAdmin, $idmenu, $textmenu) . '</div>';
    }

    function setmenudolphin($isAdmin=FALSE) {


        /*  $xBufResult ='<div id= "menuutama">'.
          '  <div id="menuitem"><img src="'.base_url().'resource/png/home.png" width="80px" height="80px"/> Home </div>'.
          '  <div id="menuitem"><img src="'.base_url().'resource/png/produk.png" width="80px" height="80px"/> Product</div>'.
          '  <div id="menuitem"><img src="'.base_url().'resource/png/pricelist.png" width="80px" height="80px"/> Price List</div>'.
          '  <div id="menuitem"><img src="'.base_url().'resource/png/portofolio.png" width="80px" height="80px"/> Portofolio</div>'.
          '  <div id="menuitem"><img src="'.base_url().'resource/png/contuctus.png" width="80px" height="80px"/> Contuct US</div>'.
          '</div>';
         *
         */
        $xlogout = '';
        if($isAdmin){
                $xlogout = '<div id="menuitem"> <a href="' . site_url('/dolphin/logout/') . '" >Logout </a></div>';
                }
        $xBufResult = '<div id= "menuutama">' .
                $this->setLinkMenu($isAdmin, 'home.png', '1', 'Home') .
                $this->setLinkMenu($isAdmin, 'produk.png', '10', 'Produk') .
                $this->setLinkMenu($isAdmin, 'pricelist.png', '11', 'Pricelist') .
                $this->setLinkMenu($isAdmin, 'portofolio.png', '12', 'Portofolio') .
                $this->setLinkMenu($isAdmin, 'contuctus.png', '13', 'Contact US') .
                $xlogout.
                '</div>';


        return $xBufResult;
    }

    function setrandomgambar() {
        $this->load->model('modelproduk');
        $Query = $this->modelproduk->getListgambarproduk();
        $xgbratas = '';
        $xgbrbawah = '';
        $i = 1;

        $xlistgambar = '';
        foreach ($Query->result() as $row) {
            

//         $config['image_library'] = 'gd2';
//         $config['upload_path'] = getcwd().'/resource/uploaded/';
//         $config['source_image'] = getcwd().'/resource/uploaded/'.$row->imagecontrol;
//         $config['create_thumb'] = TRUE;
//         $config['maintain_ratio'] = TRUE;
//         $config['width'] = 160;
//         $config['height'] = 100;
//         $this->load->library('image_lib', $config);
//
//         if ( ! $this->image_lib->resize())
//          {
//            echo $this->image_lib->display_errors().$config['source_image'];
//          }

            if ($i <= 2) {
                $xgbratas .='  <div id="gbr1"><a href="'.  site_url('ctrproduk/index/0/'.$row->idx).'"> <img src="' . base_url() . 'resource/uploaded/' . $row->imagecontrol . '" width="150"  height="180"/> <strong>'.$row->NamaProduk.' </strong></a></div>';
                //$xgbratas .='  <div id="gbr1"> <img src="'.base_url().'resource/uploaded/'.$namafile.'_thumb.'.$ext.'" /> </div>';
            } else if ($i <= 4) {
                //$xgbrbawah .='  <div id="gbr2"> <img src="'.base_url().'resource/uploaded/'.$namafile.'_thumb.'.$ext.'" /> </div>';
                $xgbrbawah .='  <div id="gbr2"> <a href="'.  site_url('ctrproduk/index/0/'.$row->idx).'"><img src="' . base_url() . 'resource/uploaded/' . $row->imagecontrol . '" width="150"  height="180"/><strong>'.$row->NamaProduk.' </strong></a> </div>';
            }
            $xlistgambar .= '<img src="' . base_url() . 'resource/uploaded/' . $row->imagecontrol . '" width="323"  height="360"/>';
            $i++;
        }

        $xImageSlider = '  <div class="slideshow" >
                           ' . $xlistgambar . '
                        </div>';
        $xBufResult = '<div id="randomgbr">' .
                '  <div id="gbratas">' .
                $xgbratas .
                /* '  <div id="gbr1"> </div>'.
                  '  <div id="gbr1"> </div>'.
                  '  <div id="gbr1"> </div>'.
                  '  <div id="gbr1"> </div>'. */
                ' </div>' .
                '    <div id="gbrtengah">' . $xImageSlider .
                //'     <div id="gbrx">'.$xImageSlider.' </div>' .
                '    </div>' .
                '  <div id="gbrbawah">' .
                $xgbrbawah .
                /*  '  <div id="gbr2"> </div>'.
                  '  <div id="gbr2"> </div>'.
                  '  <div id="gbr2"> </div>'.
                  '  <div id="gbr2"> </div>'. */
                ' </div>' .
                '</div>';
        return $xBufResult;
    }

    function SetAdminDolphin($xForm, $xList, $xAjax, $xAddScript='', $xMnKiri='') {
        $this->load->helper('form');
        $this->load->helper('html');
        $this->load->helper('common');
        if (empty($xMnKiri))
            $xMnKiri = $this->getMenuSampingKiri();
        $xMnKiriView = '';
        $xMnAtas = $this->getMenuAtas();
        $xMnKanan = '';//$this->getMenuSampingKanan();
        $xBufResult = $xForm . '</form></div> ' . $xList;

        $xMenuKiri = $this->setrandomgambar();
        $xMnHeader = $this->setmenudolphin(TRUE);
        //SetAdminDolphin($xForm, '$xShowList', 'login', '', $xAddJs);
        $xShow = setviewdolphin($xMnHeader, $xBufResult, 'admin', $xMenuKiri, $xMnKanan);
        //$xShow = setlayoutNF($xHeaderMenu, $xMnAtas, $xBufResult, $xMnKanan, $xFooterMenu, 'copyright@2011 By Voxus and icon by http://www.icondrawer.com/');

        $xecho = '<!doctype html>
       <html><head>' .
                link_tag('resource/css/jqmenuatas.css') .
                link_tag('resource/css/frmlayout.css') .
                link_tag('resource/css/menusamping.css') .
                link_tag('resource/css/dolphin.css') .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/curvycorners.src.js"></script>' .
                '
     <!--[if lte IE 7]>
    <style type="text/css">
      html .jqueryslidemenu{height: 1%;} /*Holly Hack for IE7 and below*/
    </style>
    <![endif]-->
             <script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/jquery.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/jqmenuatas.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/jquery.cycle.all.min.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/jquery.cycle.all.min.js"></script>' .
                ' <script type="text/javascript">
                $(document).ready(function() {
                 $(\'.slideshow\').cycle({
                 fx: \'curtainX\' // choose your transition type, ex: curtainX,fade, scrollUp, shuffle, etc...
                });
               });
              </script> ' .
                $xAddScript .
                '
    <script type="text/javascript">
    function initCorners() {
        var setting = {
            tl: { radius: 6 }, // top left
            tr: { radius: 6 }, // top right
            bl: { radius: 6 }, // bottom left
            br: { radius: 6 }, // bottom right
            antiAlias: true
        }

//      curvyCorners(setting, "div#headermenu0");
//      curvyCorners(setting, "div#headermenu1");
//      curvyCorners(setting, "div#headermenu2");
      

     }
   //  addEvent(window, \'load\', initCorners);
//      $("#foo1").carouFredSel();
//    </script>

      </head>
       <body>' .
                $xShow .
                '

        </body>   ' .
                '</html>';
        return $xecho;
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
            $xBufResult ='Mohon Maaf Anda tidak bisa memaksa sistem melalui Direct URL, silahkan login untuk masuk ke sistem';
           }
           
        }
        

        $xShow = setviewperpus($xMnHeader, $xBufResult, '$xImageView', '$xMenuKiri', $xMenuKanan);
        $xecho = '<!doctype html>
              <html>
              <head>' .
                link_tag('resource/css/perpus.css') .
                link_tag('resource/css/frmlayout.css') .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/curvycorners.src.js"></script>' .
                '
                     
                             <script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/jquery.js"></script>' .
                             '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/jquery.cycle.all.min.js"></script>' .
                           link_tag('resource/css/jqmenuatas.css') .
                           link_tag('resource/css/menusamping.css').
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
