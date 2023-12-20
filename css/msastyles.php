<?php header("content-type:text/css"); $themecolor="#".$_REQUEST['c']; $themecolordark="#".$_REQUEST['c2']; $header="#".$_REQUEST['h']; $footer="#".$_REQUEST['f']; //#ED8323  #E27513?>
<style type="text/css">
 
a {
  color: <?php echo $themecolor;?>;
  text-decoration: none;
}
a:hover {
  color: <?php echo $themecolordark;?>;
  text-decoration: none;
} 
* > small,
small {
  color: #000;
  font-size: 10px;
  line-height: 1.4000000000000001em;
}
big,
.text-lg {
  color: #686868;
  font-size: 16px;
  line-height: 1.78em;
}
.page-title {
  font-size: 75px;
  margin: 30px 0;
}
@media (max-width:992px) {
  .page-title {
    font-size: 50px;
  }
}
 
a.text-white:hover {
  color: #fff;
}
.text-udl {
  text-decoration: underline;
}
a.text-udl:hover {
  text-decoration: underline;
}
.text-default {
  color: #000;
}
.text-color {
  color: <?php echo $themecolor;?> !important;
}
.text-darken {
  color: #000000;
}
a.text-darken {
  color: #000000;
}
a.text-darken:hover {
  color: #3f3f3f;
}
.text-smaller {
  font-size: 75%;
}
.text-small {
  font-size: 12px;
  line-height: 1.5em;
}
.text-small p {
  margin-bottom: 4px;
  font-size: 11px;
  line-height: 1.4em;
}
.text-small h5 {
  font-size: 14px;
  line-height: 1em;
  margin-bottom: 4px;
}
.text-tiny {
  font-size: 10px;
}
.text-bigger {
  font-size: 125%;
  line-height: 1.5em;
}
.text-darken {
  color: #626262;
}
.text-gray {
  color: #808080;
}
.lh1em {
  line-height: 1em;
}
.text-hero {
  font-size: 200px;
  line-height: 1em;
}
.text-xl {
  font-size: 100px;
  line-height: 1em;
}
.uc,
.text-uc {
  text-transform: uppercase;
}
blockquote {
  position: relative;
  padding: 0 0 0 40px;
  margin: 10px 20px;
  border: none;
  line-height: 1.6em;
}
blockquote:before {
  content: '\f10e';
  font-family: 'FontAwesome';
  top: 0;
  left: 0;
  font-size: 30px;
  position: absolute;
} 
.btn-primary-invert:hover {
  color: #fff;
  background: #1070c6;
  border-color: #0e63b0;
}
.btn-paypal {
  background: #0079c1;
  color: #fff;
  border-color: #006dae;
}
.btn-paypal:hover {
  color: #fff;
  background: #006dae;
  border-color: #00619a;
}
.btn-ghost {
  background: none;
}
.btn-ghost.btn-primary {
  color: <?php echo $themecolor;?>;
}
.btn-ghost.btn-primary:hover {
  background: <?php echo $themecolor;?>;
}
.btn-ghost.btn-success {
  color: #5cb85c;
}
.btn-ghost.btn-success:hover {
  background: #5cb85c;
}
.btn-ghost.btn-info {
  color: #5bc0de;
}
.btn-ghost.btn-info:hover {
  background: #5bc0de;
}
.btn-ghost.btn-warning {
  color: #f0ad4e;
}
.btn-ghost.btn-warning:hover {
  background: #f0ad4e;
}
.btn-ghost.btn-danger {
  color: #d9534f;
}
.btn-ghost.btn-danger:hover {
  background: #d9534f;
}
.btn-ghost.btn-primary-invert {
  color: #127cdc;
}
.btn-ghost.btn-primary-invert:hover {
  background: #127cdc;
}
.btn-ghost:hover {
  color: #fff;
}
.btn-ghost.btn-default:hover {
  color: #454545;
}
.btn-ghost.btn-white {
  border-color: #fff;
  color: #fff;
}
.btn-ghost.btn-white:hover {
  background: #fff;
  color: #000;
}
.mb0 {
  margin-bottom: 0 !important;
}
.mt0 {
  margin-top: 0 !important;
}
.mr0 {
  margin-right: 0 !important;
}
.ml0 {
  margin-left: 0 !important;
}
.mb5 {
  margin-bottom: 5px !important;
}
.mt5 {
  margin-top: 5px !important;
}
.mr5 {
  margin-right: 5px !important;
}
.ml5 {
  margin-left: 5px !important;
}
.mb10 {
  margin-bottom: 10px !important;
  width: 300px;
  float: left;
}
.mt10 {
  margin-top: 10px !important;
}
.mr10 {
  margin-right: 10px !important;
}
.ml10 {
  margin-left: 10px !important;
}
.mb15 {
  margin-bottom: 15px !important;
}
.mt15 {
  margin-top: 15px !important;
}
.mr15 {
  margin-right: 15px !important;
}
.ml15 {
  margin-left: 15px !important;
}
.mb20 {
  margin-bottom: 20px !important;
}
.mt20 {
  margin-top: 20px !important;
}
.mr20 {
  margin-right: 20px !important;
}
.ml20 {
  margin-left: 20px !important;
}
.mb30 {
  margin-bottom: 30px !important;
}
.mt30 {
  margin-top: 30px !important;
}
.mr30 {
  margin-right: 30px !important;
}
.ml30 {
  margin-left: 30px !important;
}
.mb40 {
  margin-bottom: 40px !important;
}
.mt40 {
  margin-top: 40px !important;
}
.mr40 {
  margin-right: 40px !important;
}
.ml40 {
  margin-left: 40px !important;
}
.mb50 {
  margin-bottom: 50px !important;
}
.mt50 {
  margin-top: 50px !important;
}
.mr50 {
  margin-right: 50px !important;
}
.ml50 {
  margin-left: 50px !important;
}
.pt30 {
  padding-top: 30px !important;
}
.pb30 {
  padding-bottom: 30px !important;
}
.pr30 {
  padding-right: 30px !important;
}
.pl30 {
  padding-left: 30px !important;
}
.pt40 {
  padding-top: 40px !important;
}
.pb40 {
  padding-bottom: 40px !important;
}
.pr40 {
  padding-right: 40px !important;
}
.pl40 {
  padding-left: 40px !important;
}
.pt50 {
  padding-top: 50px !important;
}
.pb50 {
  padding-bottom: 50px !important;
}
.pr50 {
  padding-right: 50px !important;
}
.pl50 {
  padding-left: 50px !important;
}
.box {
  padding: 15px 17px;
}
.br5 {
  -webkit-border-radius: 5px;
  border-radius: 5px;
}
.bg-gray {
  background: #f2f2f2;
}
.row.row-wrap > [class^="col-"],
.row.row-col-gap > [class^="col-"] {
  margin-bottom: 30px;
}
.row.row-full {
  margin-left: 0;
  margin-right: 0;
}
.row.row-no-gutter,
.row[data-gutter="0"] {
  margin: 0 !important;
}
.row.row-no-gutter > [class^="col-"],
.row[data-gutter="0"] > [class^="col-"] {
  padding: 0 !important;
}
.row[data-gutter="10"] {
  margin-left: -5px;
  margin-right: -5px;
}
.row[data-gutter="10"] > [class^="col-"] {
  padding-left: 5px;
  padding-right: 5px;
}
.row[data-gutter="60"] {
  margin-left: -30px;
  margin-right: -30px;
}
.row[data-gutter="60"] > [class^="col-"] {
  padding-left: 30px;
  padding-right: 30px;
}
.row[data-gutter="120"] {
  margin-left: -60px;
  margin-right: -60px;
}
.row[data-gutter="120"] > [class^="col-"] {
  padding-left: 60px;
  padding-right: 60px;
}
label {
  font-weight: 400;
  display: block;
}
.form-group {
  position: relative;
}
.form-group.form-group-ghost ::-webkit-input-placeholder {
  color: rgba(255,255,255,0.5);
}
.form-group.form-group-ghost :-moz-placeholder {
  color: rgba(255,255,255,0.5);
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.form-group.form-group-ghost ::-moz-placeholder {
  color: rgba(255,255,255,0.5);
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.form-group.form-group-ghost :-ms-input-placeholder {
  color: rgba(255,255,255,0.5);
}
.form-group.form-group-ghost label {
  color: #fff;
}
.form-group.form-group-ghost .input-icon {
  color: #fff;
}
.form-group.form-group-ghost.form-group-focus .input-icon-hightlight {
  color: <?php echo $themecolor;?> !important;
}
.form-group.form-group-ghost .form-control {
  background: rgba(255,255,255,0.1);
  border-color: #fff;
  color: #fff;
}
.form-group.form-group-ghost .form-control:hover {
  cursor: pointer;
}
.form-group.form-group-ghost .form-control:active,
.form-group.form-group-ghost .form-control:focus {
  border-color: <?php echo $themecolor;?>;
}
.form-group.form-group-lg {
  margin-bottom: 25px;
}
.form-group.form-group-lg .input-icon {
  width: 45px;
  height: 45px;
  line-height: 55px;
  font-size: 22px;
}
.form-group.form-group-lg.form-group-icon-left .form-control {
  padding-left: 45px;
  border-radius:25px;
}
.form-group.form-group-lg.form-group-icon-right .form-control {
  padding-right: 45px;
}
.form-group.form-group-lg label {
  font-size: 16px;
  margin-bottom: 7px;
}
.form-group.form-group-lg .form-control {
  height: 45px;
  padding: 10px 18px;
  font-size: 13px;
  border-radius:25px;
}
.form-group.form-group-sm {
  margin-bottom: 10px;
}
.form-group.form-group-sm label {
  margin-bottom: 3px;
  font-size: 13px;
}
.form-group.form-group-sm .form-control {
  height: 25px;
  padding: 3px 7px;
  font-size: 12px;
  line-height: 1.4em;
}
.form-group.form-group-icon-left .form-control {
  padding-left: 32px;
}
.form-group.form-group-icon-right .form-control {
  padding-right: 32px;
}
.form-group .input-icon {
  position: absolute;
  width: 32px;
  height: 32px;
  line-height: 32px;
  display: block;
  top: 22px;
  left: 1px;
  text-align: center;
  color: #b3b3b3;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
  z-index: 2;
}
.form-group .input-icon.input-icon-show {
  -webkit-transform: translate3d(0, -10px, 0);
  -moz-transform: translate3d(0, -10px, 0);
  -o-transform: translate3d(0, -10px, 0);
  -ms-transform: translate3d(0, -10px, 0);
  transform: translate3d(0, -10px, 0);
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.form-group .input-icon.input-icon-show + label + .form-control {
  padding: 6px 12px;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
.form-group.form-group-icon-right .input-icon {
  right: 1px;
  left: auto;
}
.form-group.form-group-focus .input-icon {
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
.form-group.form-group-focus .input-icon.input-icon-hightlight {
  color: <?php echo $themecolor;?>;
}
.form-group.form-group-focus .input-icon.input-icon-show {
  -webkit-transform: translate3d(0, 0, 0);
  -moz-transform: translate3d(0, 0, 0);
  -o-transform: translate3d(0, 0, 0);
  -ms-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.form-group.form-group-focus .input-icon.input-icon-show + label + .form-control {
  padding-left: 32px;
}
.form-group.form-group-focus .input-icon.input-icon-bounce {
  -webkit-animation: 1s bounce;
  -moz-animation: 1s bounce;
  -o-animation: 1s bounce;
  -ms-animation: 1s bounce;
  animation: 1s bounce;
}
.form-group.form-group-focus .input-icon.input-icon-swing {
  -webkit-animation: 1s swing;
  -moz-animation: 1s swing;
  -o-animation: 1s swing;
  -ms-animation: 1s swing;
  animation: 1s swing;
}
.form-group.form-group-focus .input-icon.input-icon-tada {
  -webkit-animation: 1s tada;
  -moz-animation: 1s tada;
  -o-animation: 1s tada;
  -ms-animation: 1s tada;
  animation: 1s tada;
}
.form-group.form-group-focus .input-icon.input-icon-shake {
  -webkit-animation: 1s shake;
  -moz-animation: 1s shake;
  -o-animation: 1s shake;
  -ms-animation: 1s shake;
  animation: 1s shake;
}
.form-group.form-group-filled .input-icon-show {
  -webkit-transform: translate3d(0, 0, 0);
  -moz-transform: translate3d(0, 0, 0);
  -o-transform: translate3d(0, 0, 0);
  -ms-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.form-group.form-group-filled .input-icon-show + label + .form-control {
  padding-left: 32px;
}
.form-group.form-group-filled label {
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
.form-group.form-group-filled label.label-anim {
  color: <?php echo $themecolor;?>;
  -webkit-animation: label-anim 0.5s;
  -moz-animation: label-anim 0.5s;
  -o-animation: label-anim 0.5s;
  -ms-animation: label-anim 0.5s;
  animation: label-anim 0.5s;
}
.form-group.form-group-filled label.label-highlight {
  color: <?php echo $themecolor;?>;
}
.form-control {
  -webkit-border-radius: 0;
  border-radius: 0;
  -webkit-box-shadow: none;
  box-shadow: none;
  line-height: 1.6em;
  border-radius:10px !important;
}
.form-control:active,
.form-control:focus {
  -webkit-box-shadow: none;
  box-shadow: none;
  border: 1px solid <?php echo $themecolor;?>;
}
.help-block {
  font-size: 12px;
  margin-top: 7px;
}
.checkbox,
.radio {
  margin-bottom: 15px;
  margin-top: 0;
}
.checkbox-inline label,
.radio-inline label {
  cursor: pointer;
}
.radio-inline + .radio-inline,
.checkbox-inline + .checkbox-inline {
  margin-left: 15px;
}
label.label-focus {
  color: <?php echo $themecolor;?>;
  -webkit-animation: label-anim 0.5s;
  -moz-animation: label-anim 0.5s;
  -o-animation: label-anim 0.5s;
  -ms-animation: label-anim 0.5s;
  animation: label-anim 0.5s;
}
.btn-group-select-num >.btn {
  -webkit-border-radius: 50% !important;
  border-radius: 50% !important;
  height: 28px;
  line-height: 26px;
  width: 28px;
  padding: 0;
  background: none;
  color: #000;
  border: 1px solid transparent;
}
.btn-group-select-num >.btn:hover {
  color: #000;
  border-color: #000;
  background: none;
}
.btn-group-select-num >.btn.active,
.btn-group-select-num >.btn.active:hover {
  background: <?php echo $themecolor;?>;
  border-color: <?php echo $themecolordark;?>;
  -webkit-box-shadow: none;
  box-shadow: none;
  color: #fff;
}
.form-group-lg .btn-group-select-num {
  margin-top: 3px;
}
.form-group-lg .btn-group-select-num > .btn {
  height: 35px;
  line-height: 35px;
  width: 35px;
}
@-moz-keyframes label-anim {
  0% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: translate3d(0, 10px, 0);
    -moz-transform: translate3d(0, 10px, 0);
    -o-transform: translate3d(0, 10px, 0);
    -ms-transform: translate3d(0, 10px, 0);
    transform: translate3d(0, 10px, 0);
  }

  100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
    -webkit-transform: translate3d(0, 0, 0);
    -moz-transform: translate3d(0, 0, 0);
    -o-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
@-webkit-keyframes label-anim {
  0% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: translate3d(0, 10px, 0);
    -moz-transform: translate3d(0, 10px, 0);
    -o-transform: translate3d(0, 10px, 0);
    -ms-transform: translate3d(0, 10px, 0);
    transform: translate3d(0, 10px, 0);
  }

  100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
    -webkit-transform: translate3d(0, 0, 0);
    -moz-transform: translate3d(0, 0, 0);
    -o-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
@-o-keyframes label-anim {
  0% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: translate3d(0, 10px, 0);
    -moz-transform: translate3d(0, 10px, 0);
    -o-transform: translate3d(0, 10px, 0);
    -ms-transform: translate3d(0, 10px, 0);
    transform: translate3d(0, 10px, 0);
  }

  100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
    -webkit-transform: translate3d(0, 0, 0);
    -moz-transform: translate3d(0, 0, 0);
    -o-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
@-ms-keyframes label-anim {
  0% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: translate3d(0, 10px, 0);
    -moz-transform: translate3d(0, 10px, 0);
    -o-transform: translate3d(0, 10px, 0);
    -ms-transform: translate3d(0, 10px, 0);
    transform: translate3d(0, 10px, 0);
  }

  100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
    -webkit-transform: translate3d(0, 0, 0);
    -moz-transform: translate3d(0, 0, 0);
    -o-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
@keyframes label-anim {
  0% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: translate3d(0, 10px, 0);
    -moz-transform: translate3d(0, 10px, 0);
    -o-transform: translate3d(0, 10px, 0);
    -ms-transform: translate3d(0, 10px, 0);
    transform: translate3d(0, 10px, 0);
  }

  100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
    -webkit-transform: translate3d(0, 0, 0);
    -moz-transform: translate3d(0, 0, 0);
    -o-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
}
.slimmenu-menu-collapser {
  position: relative;
  background-color: #333;
  color: #fff;
  width: 100%;
  height: 48px;
  line-height: 48px;
  font-size: 16px;
  padding: 0 8px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  float:left;
  
}
.slimmenu-collapse-button {
  position: absolute;
  right: 8px;
  top: 50%;
  width: 40px;
  -webkit-border-radius: 40px;
  border-radius: 40px;
  color: #fff;
  padding: 7px 10px;
  cursor: pointer;
  font-size: 14px;
  text-align: center;
  -webkit-transform: translate(0, -50%);
  -moz-transform: translate(0, -50%);
  -o-transform: translate(0, -50%);
  -ms-transform: translate(0, -50%);
  transform: translate(0, -50%);
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
.slimmenu-collapse-button .slimmenu-icon-bar {
  background-color: #f5f5f5;
  -webkit-border-radius: 1px;
  border-radius: 1px;
  -webkit-box-shadow: 0 1px rgba(0,0,0,0.25);
  box-shadow: 0 1px rgba(0,0,0,0.25);
  display: block;
  height: 2px;
  width: 18px;
  margin: 2px 0;
}
ul.slimmenu {
  list-style: none;
  margin: 0;
  padding: 0;
  width: 100%;
}
ul.slimmenu li {
  position: relative;
  display: inline-block;
}
ul.slimmenu li a {
  display: block;
  padding: 12px 20px;
  font-size: 15px;

  font-family: 'Roboto', arial, helvetica, sans-serif;
  color: #000;
  -webkit-transition: background-color 0.17s ease-out;
  -moz-transition: background-color 0.17s ease-out;
  -o-transition: background-color 0.17s ease-out;
  -ms-transition: background-color 0.17s ease-out;
  transition: background-color 0.17s ease-out;
}
ul.slimmenu li.slimmenu-sub-menu a {
  padding: 12px 28px 12px 20px;
  border-radius:0px;
  border-top-right-radius: 0;
  border-bottom-left-radius: 0;
}
ul.slimmenu li.active > a,
ul.slimmenu li:hover > a {
  background: <?php echo $themecolor;?>;
  color: #fff;
  border-radius: 0px !important;
    border-top-right-radius: 0;
    border-bottom-left-radius: 0;
}
ul.slimmenu li.active .slimmenu-sub-collapser > i,
ul.slimmenu li:hover .slimmenu-sub-collapser > i {
  color: #fff;
  
}
.search-tabs-bg > .tabbable > .nav-tabs > li > a:focus{outline:none;}

ul.slimmenu li .slimmenu-sub-collapser {
  position: absolute;
  right: 11px;
  top: 0;
  width: 20px;
  height: 100%;
  text-align: center;
  z-index: 999;
  cursor: pointer;
}
ul.slimmenu li .slimmenu-sub-collapser:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
}
ul.slimmenu li .slimmenu-sub-collapser > i {
  text-align: center;
  color: #333;
  font-size: 18px;
  vertical-align: middle;
}
ul.slimmenu li ul {
  margin: 0;
  list-style: none;
}
ul.slimmenu li ul li {
  display: block;
}
ul.slimmenu li ul li a {
  background-color: #333;
  color: #fff;
}
ul.slimmenu li > ul {
  display: none;
  position: absolute;
  left: 0;
  top: 100%;
  z-index: 999;
  padding: 0;
  min-width: 170px;
}
ul.slimmenu li > ul > li ul {
  display: none;
  position: absolute;
  left: 100%;
  top: 0;
  z-index: 999;
  width: 100%;
}
ul.slimmenu.slimmenu-collapsed li {
  display: block;
  float:left;
  width: 100%;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
ul.slimmenu.slimmenu-collapsed li ul li a {
  background: none;
  color: <?php echo $themecolor;?>;
}
ul.slimmenu.slimmenu-collapsed li ul li a:hover {
  background: <?php echo $themecolor;?>;
  color: #fff;
}
ul.slimmenu.slimmenu-collapsed li a {
  display: block;
  border-bottom: 1px solid rgba(0,0,0,0.075);
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
ul.slimmenu.slimmenu-collapsed li > ul {
  display: none;
  position: static;
  width: 100%;
  padding-left: 50px;
}
ul.slimmenu.slimmenu-collapsed li .slimmenu-sub-collapser {
  height: 50px;
  width: 50px;
  right: 0;
  background: <?php echo $themecolordark;?>;
}
ul.slimmenu.slimmenu-collapsed li .slimmenu-sub-collapser > i {
  color: #fff;
}
.gap {
  display: block;
  position: relative;
  margin: 30px 0 30px 0;
  clear: both;
}
.gap:after {
  clear: both;
  content: '';
  display: table;
}
.gap-small {
  margin: 15px 0 15px 0;
}
.gap-mini {
  margin: 10px 0 10px 0;
}
.gap-big {
  margin: 60px 0 60px 0;
}
.gap-large {
  margin: 90px 0 90px 0;
}
.gap-top {
  margin-bottom: 0 !important;
}
.gap-bottom {
  margin-top: 0 !important;
}
.gap-border {
  border: 0;
  border-top: 1px solid #ededed;
  border-bottom: 1px solid #fff;
}
.search-tabs > .tabbable >.tab-content > .tab-pane {
  padding: 15px;
}
.search-tabs > .tabbable > .nav-tabs > li > a {
  text-transform: uppercase;
}
.search-tabs-abs {
  position: absolute;
  top: 0;
  left: 14%;
  width: 55%;
}
@media (max-width:992px) {
  .search-tabs-abs {
    position: relative;
    width: 70%;
  }
}
.search-tabs-abs-bottom {
  position: absolute;
  top: 320px;
}
@media (max-width:992px) {
  .search-tabs-abs-bottom {
    position: relative;
    top: 0;
    margin: 50px 0;
  }
}
.search-tabs-bottom {
  position: absolute;
  left: 0;
  top: 50px;
  width: 100%;
}
@media (max-width:992px) {
  .search-tabs-bottom {
    position: relative;
    bottom: auto;
    top: 0;
    margin-top: 50px;
  }
}
.search-tabs-to-top {
  position: relative;
  z-index: 10;
  margin-top: -120px;
}
.search-tabs-bg > h1 {
  color: #fff;
  margin-bottom: 25px;
}
.search-tabs-bg > .tabbable >.tab-content > .tab-pane {
  background: #fff;
  padding: 25px;
  -webkit-box-shadow: 0 2px 1px rgba(0,0,0,0.15);
  box-shadow: 0 2px 1px rgba(0,0,0,0.15);
}
.search-tabs-bg > .tabbable >.tab-content > .tab-pane .form-control {
  background: rgba(255,255,255,0.5);
  border-radius:25px;
}

.search-tabs-bg > .tabbable > .nav-tabs {
  border: none;
}
.search-tabs-bg > .tabbable > .nav-tabs > li {
  margin-bottom: 0;

}
.search-tabs-bg > .tabbable > .nav-tabs > li > a {
  background: rgba(0,0,0,0.4);
  border: none !important;
  color: #fff;
 // border-radius: 25px;
  //border-bottom-left-radius: 0px;
   //border-top-right-radius: 0px;
}
@media (max-width:992px) {
  .search-tabs-bg > .tabbable > .nav-tabs > li > a > span {
    display: none;
  }
}
.search-tabs-bg > .tabbable > .nav-tabs > li > a:hover > .fa {
  background: <?php echo $themecolor;?>;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
.search-tabs-bg > .tabbable > .nav-tabs > li > a > .fa {
  display: inline-block;
  width: 30px;
  height: 30px;
  line-height: 30px;
  margin-right: 2px;
  background: rgba(0,0,0,0.3);
  -webkit-border-radius: 50%;
  border-radius: 50%;
  text-align: center;
}
.search-tabs-bg > .tabbable > .nav-tabs > li.active > a {
  background: <?php echo $themecolor;?>;
  color: #fff;
  padding-top: 15px;
  margin-top: -5px;
}
.search-tabs-bg > .tabbable > .nav-tabs > li.active > a:hover > .fa {
  background: rgba(0,0,0,0.3);
}
.search-tabs-nobox > .tabbable > .tab-content > .tab-pane {
  padding: 25px 0;
  -webkit-box-shadow: none;
  box-shadow: none;
}
.search-tabs-lift-top {
  margin-top: -50px;
}  
.thumb-caption btn {
  margin-top: 7.5px;
}
.thumb-caption .thumb-social {
  margin-top: 7.5px;
}
.thumb-caption .thumb-meta {
  margin-top: 6px;
  font-style: italic;
  margin-bottom: 0;
}
.thumb-caption .thumb-meta [class^="fa fa-"] {
  margin-right: 5px;
}
.text-white .thumb-desc {
  color: #e6e6e6;
}
.text-white .thumb-title {
  color: #fff;
}
.thumb-progress {
  margin-top: 6px;
  margin-bottom: 0;
}
.post {
  margin-bottom: 45px;
  overflow: hidden;
  background: #fff;
  border-bottom: 1px solid #e6e6e6;
}
.post .post-header {
  border-bottom: 2px solid <?php echo $themecolor;?>;
}
.post .post-header blockquote {
  padding: 40px;
  font-size: 30px;
  padding-left: 60px;
  margin: 0;
  font-weight: 400;
  background: #f5f5f5;
  line-height: 1.4em;
  font-style: italic;
  color: #686868;
}
.post .post-header blockquote:before {
  top: 10px;
  left: 10px;
}
.post .post-header .post-link {
  padding: 30px 15px;
  font-size: 50px;
  font-weight: bold;
  display: block;
  background: <?php echo $themecolor;?>;
  color: #fff;
}
.post .post-header .post-link:hover {
  background: #d66f11;
  color: #fff;
}
.post .post-inner {
  padding: 15px 0 45px 0;
}
.post .post-title {
  margin: 0 0 15px 0;
  font-size: 35px;
}
.post .post-desciption {
  margin-bottom: 15px;
}
.post .post-meta {
  list-style: none;
  margin: 0 0 5px 0;
  padding: 0 0 5px 0;
  border-bottom: 1px dashed #e6e6e6;
  display: table;
}
.post .post-meta li {
  display: inline-block;
  margin-right: 20px;
}
.post .post-meta li a {
  font-size: 12px;
  font-style: italic;
  color: #000;
}
.post .post-meta li .fa {
  margin-right: 3px;
  color: #b2b2b2;
}
.thumb-list {
  list-style: none;
  margin: 0;
  padding: 0;
}
.thumb-list > li {
  margin-bottom: 7px;
  padding-bottom: 7px;
  border-bottom: 1px dashed #e6e6e6;
  overflow: hidden;
}
 
.thumb-list > li .thumb-list-item-caption {
  display: table;
}
.thumb-list > li .thumb-list-item-caption .icon-list-rating {
  font-size: 9px;
  color: <?php echo $themecolor;?>;
  margin-bottom: -3px;
}
.thumb-list > li .thumb-list-item-caption .icon-list-rating.icon-list-non-rated {
  color: #8f8f8f !important;
}
.thumb-list > li .thumb-list-item-caption .thumb-list-item-title {
  font-size: 13px;
  margin-bottom: 3px;
  margin-top: 2px;
}
.thumb-list > li .thumb-list-item-caption .thumb-list-item-title a {
  color: #686868;
}
.thumb-list > li .thumb-list-item-caption .thumb-list-item-title a:hover {
  text-decoration: underline;
}
.thumb-list > li .thumb-list-item-caption .thumb-list-item-desciption {
  font-size: 11px;
  margin: 0;
  color: #969696;
  line-height: 1.4em;
}
.thumb-list > li .thumb-list-item-caption .thumb-list-item-meta {
  margin-bottom: 2px;
  line-height: 1em;
  font-size: 9px;
  color: #8f8f8f;
  font-style: italic;
}
.thumb-list > li .thumb-list-item-caption .thumb-list-item-price {
  font-size: 16px;
  color: #000;
  margin-bottom: 0;
}
.thumb-list > li .thumb-list-item-caption .thumb-list-item-author {
  font-size: 11px;
  color: #8f8f8f;
  font-style: italic;
}
.thumb-list > li:last-child {
  margin-bottom: 0;
  padding-bottom: 0;
  border: none;
}
 
.nav-tabs > li > a {
  -webkit-border-radius: 0;
  border-radius: 0;
}
@media (min-width:992px) {
  body.boxed .global-wrap {
    width: 1230px;
    margin: 30px auto;
    -webkit-box-shadow: 0 4px 2px rgba(0,0,0,0.2);
    box-shadow: 0 4px 2px rgba(0,0,0,0.2);
  }
}
.global-wrap {
  background: #fff;
  height: 100%;
}
.dis-table {
  display: table;
}
.full,
.full-page {
  width: 100%;
  height: 100%;
}
@media (max-width:992px) {
  .full,
  .full-page {
    min-height: 1000px;
  }
}
.rel {
  position: relative;
}
.full-height {
  height: 100%;
}
.full-page {
  position: relative;
}
.top-area,
.special-area {
  height: 700px;
  position: relative;
  overflow: hidden;
  z-index:0000;
}
@media (max-width:992px) {
  .top-area,
  .special-area {
    height: auto;
  }
}
.special-area {
  height: 500px;
}
.bg-cover {
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-size: cover;
  background-attachment: fixed;
  background-position: center center;
  background-repeat: no-repeat;
}
.bg-darken {
  background: #f2f2f2;
}
.bg-color {
  background: <?php echo $themecolor;?>;
}
.bg-holder {
  position: relative;
  overflow: hidden;
}
.bg-holder > .bg-mask,
.bg-holder > .bg-blur,
.bg-holder > .bg-mask-darken,
.bg-holder > .bg-mask-lighten,
.bg-holder > .bg-parallax,
.bg-holder > .bg-img,
.bg-holder > .bg-video {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-size: cover;
  background-position: center center;
}
.bg-holder > .bg-video {
  width: 100%;
  height: auto;
  z-index: 4;
}
 
.bg-holder > .bg-mask,
.bg-holder > .bg-mask-darken,
.bg-holder > .bg-mask-lighten,
.bg-holder > .bg-mask-white,
.bg-holder > .bg-mask-color,
.bg-holder > .bg-mask-color-invert {
  width: 100%;
  height: 100%;
  z-index: 5;
  opacity: 0.5;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
  filter: alpha(opacity=50);
  background: #000;
}
.bg-holder > .bg-mask-lighten {
  opacity: 0.3;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=30)";
  filter: alpha(opacity=30);
}
.bg-holder > .bg-mask-darken {
  opacity: 0.8;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
  filter: alpha(opacity=80);
}
.bg-holder > .bg-mask-color {
  background: <?php echo $themecolor;?>;
}
.bg-holder > .bg-mask-white {
  background: #fff;
}
.bg-holder > .bg-mask-color-invert {
  background: #127cdc;
}
.bg-holder > .bg-parallax {
  background-position: 50% 0;
  background-attachment: fixed;
}
.bg-holder > .bg-blur {
  width: 50% !important;
  height: 50% !important;
  -webkit-transform-origin: 1% 1%;
  -moz-transform-origin: 1% 1%;
  -o-transform-origin: 1% 1%;
  -ms-transform-origin: 1% 1%;
  transform-origin: 1% 1%;
  -webkit-transform: scale(2.1);
  -moz-transform: scale(2.1);
  -o-transform: scale(2.1);
  -ms-transform: scale(2.1);
  transform: scale(2.1);
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-size: cover;
  -webkit-filter: blur(2px);
  -moz-filter: blur(2px);
  -o-filter: blur(2px);
  filter: blur(2px);
  z-index: 0;
}
.bg-holder > .bg-blur:before {
  content: '';
  -webkit-backface-visibility: hidden;
  -moz-backface-visibility: hidden;
  -ms-backface-visibility: hidden;
  backface-visibility: hidden;
}
.bg-holder > .bg-blur.bg-parallax {
  background-attachment: scroll;
}
.bg-holder > .bg-holder-content,
.bg-holder > .bg-content {
  position: relative;
  z-index: 7;
}
.bg-holder > .bg-front {
  top: 0;
  left: 0;
  width: 100%;
  position: absolute;
  z-index: 6;
}
@media (max-width:992px) {
  .bg-holder > .bg-front.bg-front-mob-rel {
    position: relative;
  }
}
.vert-center {
  left: 0 !important;
  position: absolute !important;
  top: 50% !important;
  -webkit-transform: translate(0, -50%);
  -moz-transform: translate(0, -50%);
  -o-transform: translate(0, -50%);
  -ms-transform: translate(0, -50%);
  transform: translate(0, -50%);
}
.hor-center {
  left: 50% !important;
  position: absolute !important;
  top: 0 !important;
  -webkit-transform: translate(-50%, 0);
  -moz-transform: translate(-50%, 0);
  -o-transform: translate(-50%, 0);
  -ms-transform: translate(-50%, 0);
  transform: translate(-50%, 0);
}
.full-center {
  left: 50% !important;
  position: absolute !important;
  top: 50% !important;
  -webkit-transform: translate(-50%, -50%);
  -moz-transform: translate(-50%, -50%);
  -o-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}
.to-top {
  -webkit-transform: translate(0, -50%);
  -moz-transform: translate(0, -50%);
  -o-transform: translate(0, -50%);
  -ms-transform: translate(0, -50%);
  transform: translate(0, -50%);
  position: relative;
  z-index: 10;
}
.loc-info {
  opacity: 1;
  -ms-filter: none;
  filter: none;
  padding-top: 50px;
  color: #fff;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
  -webkit-transform: translate3d(0, 0, 0);
  -moz-transform: translate3d(0, 0, 0);
  -o-transform: translate3d(0, 0, 0);
  -ms-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
}
.loc-info .loc-info-title {
  color: #fff;
}
 
.loc-info .loc-info-weather {
  margin: 0;
}
.loc-info .loc-info-weather-icon {
  font-size: 60px;
  margin-left: 5px;
}
.loc-info .loc-info-weather-num {
  font-size: 30px;
  position: relative;
  top: -15px;
}
.loc-info .loc-info-weather-num .meteocon {
  margin-left: -5px;
}
.loc-info .loc-info-list {
  list-style: none;
  padding: 0;
  margin: 5px 0 10px 0;
  font-size: 13px;
}
.loc-info .loc-info-list > li > a {
  color: #fff;
  opacity: 0.8;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
  filter: alpha(opacity=80);
}
.loc-info .loc-info-list > li > a .fa {
  margin-right: 5px;
}
.loc-info .loc-info-list > li > a:hover {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.round {
  -webkit-border-radius: 50%;
  border-radius: 50%;
}
 
.curved {
  -webkit-border-radius: 5px;
  border-radius: 5px;
}
 
 
 
.header-top {
  padding: 10px 0;
  max-height: 60px;
  background: <?php echo $header;?>;
}
@media (max-width:992px) {
  .header-top {
    max-height: none;
  }
}
 
.top-user-area {
  font-size: 12px;
  position: relative;
}
.top-user-area > ul >li {
  line-height: 40px;
}
.top-user-area .top-user-area-list {
  position: absolute;
  top: 0;
  right: 0;
}
@media (max-width:992px) {
  .top-user-area .top-user-area-list {
    margin-top: 10px;
    position: relative;
  }
}
.top-user-area .top-user-area-list > li {
  position: relative;
  border: none !important;
}
.top-user-area .top-user-area-list > li:after {
  content: '';
  position: absolute;
  top: 30%;
  right: 0;
  height: 40%;
  background: rgba(255,255,255,0.13);
  width: 1px;
}
.top-user-area .top-user-area-list > li:last-child:after {
  background: none;
}
.top-user-area .top-user-area-list > li > a {
  color: #f2f2f2;
}
.top-user-area .top-user-area-list > li > a:hover {
  color: <?php echo $themecolor;?>;
}
.top-user-area .top-user-area-list > li.top-user-area-avatar {
  font-weight: 400;
}
 
 
 
.top-user-area .top-user-area-list > li.top-user-area-lang .nav-drop-menu li a {
  line-height: 20px;
}
 
div.nav-drop {
  display: inline-block;
}
.nav-drop {
  position: relative;
  padding-right: 23px !important;
}
.nav-drop .fa-angle-up,
.nav-drop .fa-angle-down {
  position: absolute;
  right: 8px;
  line-height: inherit;
  top: 0;
  font-size: 90%;
  opacity: 0.7;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=70)";
  filter: alpha(opacity=70);
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
.nav-drop .fa-angle-up {
  top: 5px;
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.nav-drop > .nav-drop-menu {
  min-width: 85px;
  height: 0;
  overflow: hidden;
  position: absolute;
  z-index: 999;
  left: -5px;
  color: #fff;
  -webkit-transform: translate3d(0, 10px, 0);
  -moz-transform: translate3d(0, 10px, 0);
  -o-transform: translate3d(0, 10px, 0);
  -ms-transform: translate3d(0, 10px, 0);
  transform: translate3d(0, 10px, 0);
  opacity: 0;
  display: none;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: opacity 0.3s, -webkit-transform 0.3s;
  -moz-transition: opacity 0.3s, -moz-transform 0.3s;
  -o-transition: opacity 0.3s, -o-transform 0.3s;
  -ms-transition: opacity 0.3s, -ms-transform 0.3s;
  transition: opacity 0.3s, transform 0.3s;
  list-style: none;
  margin: 0;
  padding: 0;
}
.nav-drop > .nav-drop-menu > li > a {
  background: #333;
  color: #fff;
  padding: 10px 15px;
  line-height: 1em;
  border-bottom: 1px solid #262626;
  display: block;
  position: relative;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
.nav-drop > .nav-drop-menu > li > a > .right {
  float: right;
}
.nav-drop > .nav-drop-menu > li > a:hover {
  background: <?php echo $themecolor;?>;
}
.nav-drop > .nav-drop-menu > li:last-child > a {
  border-bottom: none;
}
.nav-drop > .nav-drop-menu > li:first-child > a:before {
  position: absolute;
  content: '';
  width: 0px;
  height: 0px;
  border-style: solid;
  border-width: 0 10px 10px 10px;
  border-color: transparent transparent #262626 transparent;
  top: -10px;
  left: 10px;
}
.nav-drop.active-drop .fa-angle-up {
  top: 0;
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.nav-drop.active-drop .fa-angle-down {
  top: 5px;
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.nav-drop.active-drop > .nav-drop-menu {
  height: auto;
  overflow: visible;
  opacity: 1;
  display: block;
  -ms-filter: none;
  filter: none;
  -webkit-transform: translate3d(0, 0, 0);
  -moz-transform: translate3d(0, 0, 0);
  -o-transform: translate3d(0, 0, 0);
  -ms-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
}
.list {
  list-style: none;
  margin: 0;
  padding: 0;
}
.list-center {
  display: table;
  margin: 0 auto;
}
.list-inline-block > li {
  display: inline-block;
}
.list-horizontal > li,
.list-inline > li {
  float: left;
  margin-right: 10px;
  padding: 0;
  display: block;
}
.list-horizontal > li:last-child,
.list-inline > li:last-child {
  margin-right: 0;
}
.list-horizontal.list-border > li,
.list-inline.list-border > li {
  margin-right: 10px;
  padding-right: 10px;
  border-right: 1px solid rgba(0,0,0,0.13);
}
.list-horizontal.list-border > li:last-child,
.list-inline.list-border > li:last-child {
  margin-right: 0;
  padding-right: 0;
  border: none;
}
.list-horizontal:after,
.list-inline:after {
  content: '.';
  display: block;
  height: 0;
  clear: both;
  visibility: hidden;
}
.breadcrumb {
  background: none;
  padding: 0;
  font-size: 13px;
  margin-top: 15px;
  margin-bottom: 0;
}
.breadcrumb > li + li:before {
  content: '\f105';
  font-family: 'FontAwesome';
  padding: 0 7px;
}
footer#main-footer {
  background: <?php echo $footer;?>;
  padding: 60px 0 30px 0;
  color: #e6e6e6;
  font-size: 11px;
  line-height: 1.4em;
}
footer#main-footer .logo {
  margin-bottom: 15px;
}
footer#main-footer a,
footer#main-footer h1,
footer#main-footer h2,
footer#main-footer h3,
footer#main-footer h4,
footer#main-footer h5 {
  color: #fff;
}
footer#main-footer .form-control {
  //background: <?php echo $themecolor;?>;
  border-color: <?php echo $themecolordark;?>;
  //color: #fff;
}
footer#main-footer .form-control:focus {
  border-color: <?php echo $themecolor;?>;
}
.list-footer > li {
  margin-bottom: 5px;
}
.list-footer > li > a:hover {
  text-decoration: underline;
}
header#main-header {
  border-bottom: 2px solid <?php echo $themecolor;?>;
}
.pagination {
  margin: 0;
  list-style: none;
  padding: 0;
  overflow: hidden;
  display: block;
  font-size: 12px;
  -webkit-border-radius: 0;
  border-radius: 0;
}
.pagination > li {
  display: block;
  float: left;
  min-width: 35px;
}
.pagination > li > a {
  border: none;
  color: <?php echo $themecolor;?>;
  -webkit-border-radius: 0 !important;
  border-radius: 0 !important;
  -webkit-transition: 0.2s;
  -moz-transition: 0.2s;
  -o-transition: 0.2s;
  -ms-transition: 0.2s;
  transition: 0.2s;
}
.pagination > li > a:hover {
  background: #4d4d4d;
  color: #fff;
}
.pagination > li.active > a,
.pagination > li.active > a:hover {
  background: <?php echo $themecolor;?>;
}
.pagination > li.dots {
  line-height: 16px;
  text-align: center;
  font-size: 30px;
  color: #ccc;
}
.nav-pills > li.active > a {
  background: <?php echo $themecolor;?>;
  cursor: default;
}
.nav-pills > li.active > a:hover {
  background: <?php echo $themecolor;?>;
}
.nav-sm > li > a {
  padding: 5px 10px;
  font-size: 13px;
  background: #eee;
}
.nav-no-br > li > a {
  -webkit-border-radius: 0;
  border-radius:4px;
}
.nav-bot-space {
  margin-bottom: 15px;
}
.card-select {
  list-style: none;
  margin: 0;
  padding: 0;
}
.card-select > li {
  overflow: hidden;
  padding: 10px 15px;
  border: 1px solid #ccc;
  -webkit-border-radius: 3px;
  border-radius: 3px;
  margin-bottom: 15px;
  cursor: pointer;
  width: 90%;
}
.card-select > li.card-item-selected {
  border-color: <?php echo $themecolor;?>;
}
.card-select > li.card-item-selected .card-select-cvc {
  display: inline-block;
}
 
.card-select .card-select-data {
  display: table;
}
.card-select .card-select-cvc {
  display: none;
  width: 60px;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
.card-select .card-select-number {
  font-size: 14px;
  display: inline-block;
  margin-right: 20px;
  line-height: 40px;
  margin-bottom: 0;
}
.order-payment-list > li {
  padding: 10px 15px;
  border-bottom: 1px dashed #ccc;
}
.order-payment-list > li:first-child {
  border-top: 1px dashed #ccc;
}
.order-payment-list > li h5,
.order-payment-list > li p {
  margin-bottom: 0;
}
.order-payment-list > li h5 .fa {
  margin-right: 10px;
}
.order-payment-list > li small {
  margin-left: 35px;
}
.addional-offers {
  font-size: 12px;
  margin-bottom: 0;
  margin-top: 5px;
  line-height: 1.4em;
}
.rounded {
  -webkit-border-radius: 50%;
  border-radius: 50%;
}
aside.sidebar-right {
  padding-left: 30px;
  border-left: 1px solid #d4d4d4;
}
aside.sidebar-left {
  padding-right: 30px;
  border-right: 1px solid #d4d4d4;
}
.sidebar-widget {
  margin-bottom: 30px;
}
.list-category > li > a {
  color: #686868;
  margin-bottom: 7px;
  padding-bottom: 7px;
  display: block;
  border-bottom: 1px dashed #f2f2f2;
}
.list-category > li > a:hover {
  color: <?php echo $themecolor;?>;
}
.address-list > li {
  margin-bottom: 20px;
}
.address-list > li > h5 {
  margin-bottom: 3px;
}
.tooltip-inner {
  -webkit-border-radius: 0;
  border-radius: 0;
}
.logo-holder {
  position: absolute;
  top: 0;
  left: 0;
  margin: 30px 0 0 30px;
  display: block;
  opacity: 0.5;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
  filter: alpha(opacity=50);
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
 
.logo-holder:hover {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.footer-links {
  list-style: none;
  font-size: 10px;
  text-align: center;
  position: absolute;
  bottom: 50px;
  width: 100%;
}
.footer-links > li {
  display: inline-block;
  margin: 0 10px;
}
.footer-links > li > a {
  opacity: 0.7;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=70)";
  filter: alpha(opacity=70);
  color: #fff;
}
.footer-links > li > a:hover {
  text-decoration: underline;
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.footer-social {
  position: absolute;
  bottom: 50px;
  text-align: center;
  width: 100%;
}
.footer-social > li {
  display: inline-block;
  margin: 0 7px;
}
.card-thumb {
  position: relative;
  height: 170px;
  -webkit-border-radius: 5px;
  border-radius: 5px;
  background: #fafafa;
  padding: 15px 20px;
  border: 1px solid #e6e6e6;
  display: block;
}
.card-thumb.card-thumb-primary {
  border-color: <?php echo $themecolor;?>;
}
.card-thumb .card-thumb-primary-label {
  position: absolute;
  top: 10px;
  left: 10px;
  display: inline-block;
  line-height: 1em;
  padding: 4px 6px;
  background: <?php echo $themecolor;?>;
  color: #fff;
  font-size: 10px;
  -webkit-border-radius: 3px;
  border-radius: 3px;
}
.card-thumb .card-thumb-new {
  height: 50px;
  line-height: 50px;
  width: 50px;
  text-align: center;
  background: <?php echo $themecolor;?>;
  color: #fff;
  -webkit-border-radius: 50%;
  border-radius: 50%;
  font-size: 30px;
  float: left;
  margin-right: 10px;
  margin-top: 45px;
  margin-left: 35px;
}
.card-thumb .card-thumb-new + p {
  margin-top: 55px;
  font-size: 12px;
}
.card-thumb .card-thumb-type {
  position: absolute;
  bottom: 10px;
  right: 10px;
  width: auto;
}
.card-thumb .card-thumb-number {
  font-size: 16px;
  color: #5c5c5c;
  font-weight: 400;
  letter-spacing: 2px;
  margin-top: 30px;
  margin-bottom: 0;
}
.card-thumb .card-thumb-valid {
  font-size: 12px;
  color: #888;
}
.card-thumb .card-thumb-valid > span {
  font-size: 15px;
  color: #626262;
}
.card-thumb .card-thumb-actions {
  list-style: none;
  margin: 0;
  padding: 0;
  position: absolute;
  top: 7px;
  right: 10px;
}
.card-thumb .card-thumb-actions > li {
  display: inline-block;
  margin-right: 8px;
}
.card-thumb .card-thumb-actions > li:last-child {
  margin-right: 0;
}
.card-thumb .card-thumb-actions > li > a {
  display: block;
  width: 23px;
  line-height: 23px;
  height: 23px;
  text-align: center;
  -webkit-border-radius: 50%;
  border-radius: 50%;
  font-size: 12px;
  -webkit-box-shadow: 0 0 0 1px #000;
  box-shadow: 0 0 0 1px #000;
  color: #000;
  opacity: 0.5;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
  filter: alpha(opacity=50);
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
.card-thumb .card-thumb-actions > li > a:hover {
  background: <?php echo $themecolor;?>;
  color: #fff;
  -webkit-box-shadow: 0 0 0 1px #d66f11;
  box-shadow: 0 0 0 1px #d66f11;
}
.card-thumb:hover .card-thumb-actions > li > a {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.spinner-clock {
  width: 150px;
  height: 150px;
  border: 4px solid #fff;
  -webkit-border-radius: 50%;
  border-radius: 50%;
  position: relative;
  margin: 0 auto 20px auto;
}
.spinner-clock:before {
  width: 12px;
  height: 12px;
  position: absolute;
  top: 50%;
  left: 50%;
  background: #fff;
  -webkit-border-radius: 50%;
  border-radius: 50%;
  content: '';
  margin: -6px 0 0 -6px;
  z-index: 1;
}
.spinner-clock .spinner-clock-hour,
.spinner-clock .spinner-clock-minute {
  -webkit-animation-name: spinner;
  -moz-animation-name: spinner;
  -o-animation-name: spinner;
  -ms-animation-name: spinner;
  animation-name: spinner;
  -webkit-animation-iteration-count: infinite;
  -moz-animation-iteration-count: infinite;
  -o-animation-iteration-count: infinite;
  -ms-animation-iteration-count: infinite;
  animation-iteration-count: infinite;
  -webkit-animation-timing-function: linear;
  -moz-animation-timing-function: linear;
  -o-animation-timing-function: linear;
  -ms-animation-timing-function: linear;
  animation-timing-function: linear;
  width: 4px;
  background: #fff;
  margin-left: -2px;
  -webkit-transform-origin: center bottom;
  -moz-transform-origin: center bottom;
  -o-transform-origin: center bottom;
  -ms-transform-origin: center bottom;
  transform-origin: center bottom;
  position: absolute;
  left: 50%;
  -webkit-border-radius: 0 0 3px 3px;
  border-radius: 0 0 3px 3px;
}
.spinner-clock .spinner-clock-minute {
  -webkit-animation-duration: 1s;
  -moz-animation-duration: 1s;
  -o-animation-duration: 1s;
  -ms-animation-duration: 1s;
  animation-duration: 1s;
  top: 15px;
  height: 56px;
  opacity: 0.8;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
  filter: alpha(opacity=80);
}
.spinner-clock .spinner-clock-hour {
  -webkit-animation-duration: 12s;
  -moz-animation-duration: 12s;
  -o-animation-duration: 12s;
  -ms-animation-duration: 12s;
  animation-duration: 12s;
  top: 31px;
  height: 40px;
}
.spinner-clock.spinner-clock-slow .spinner-clock-minute {
  -webkit-animation-duration: 3px;
  -moz-animation-duration: 3px;
  -o-animation-duration: 3px;
  -ms-animation-duration: 3px;
  animation-duration: 3px;
}
.spinner-clock.spinner-clock-slow .spinner-clock-hour {
  -webkit-animation-duration: 36s;
  -moz-animation-duration: 36s;
  -o-animation-duration: 36s;
  -ms-animation-duration: 36s;
  animation-duration: 36s;
}
.panel-default > .panel-heading {
  background: #fff;
  padding: 0;
}
.panel-group .panel {
  -webkit-border-radius: 0;
  border-radius: 0;
}
.panel-title {
  font-weight: 300;
}
.panel-title > a {
  display: block;
  position: relative;
  padding: 10px 15px;
  background: #fff;
}
.panel-title > a:before {
  font-family: 'FontAwesome';
  content: '\f107';
  position: absolute;
  font-size: 16px;
  top: 10px;
  right: 15px;
}
.tagline {
  font-size: 70px;
  font-family: 'Roboto', arial, helvetica, sans-serif;
  font-weight: 100;
  color: #fff;
  position: absolute;
  line-height: 1em;
  margin-top: -50px;
  overflow: hidden;
  height: 85px;
  top: 0;
  left: 0;
}
.tagline > span {
  float: left;
  display: block;
  height: 85px;
  line-height: 85px;
  color: rgba(255,255,255,0.85);
}
.tagline > ul {
  height: 85px;
  line-height: 85px;
  position: relative;
  top: 0;
  display: block;
  float: left;
  -webkit-perspective: 1000;
  -moz-perspective: 1000;
  -ms-perspective: 1000;
  perspective: 1000;
  list-style: none;
  margin: 0;
  padding: 0;
  width: 600px;
}
.tagline > ul > li {
  font-weight: 500;
  position: absolute;
  top: 0;
  margin: 0;
  padding-left: 15px;
  top: -85px;
  -webkit-transition: 0.5s;
  -moz-transition: 0.5s;
  -o-transition: 0.5s;
  -ms-transition: 0.5s;
  transition: 0.5s;
  -webkit-transform: rotateX(180deg);
  -moz-transform: rotateX(180deg);
  -o-transform: rotateX(180deg);
  -ms-transform: rotateX(180deg);
  transform: rotateX(180deg);
  -webkit-transform-origin: 25% 0;
  -moz-transform-origin: 25% 0;
  -o-transform-origin: 25% 0;
  -ms-transform-origin: 25% 0;
  transform-origin: 25% 0;
  width: 100%;
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.tagline > ul > li.active {
  top: 0;
  opacity: 1;
  -ms-filter: none;
  filter: none;
  -webkit-transform: rotateY(0deg);
  -moz-transform: rotateY(0deg);
  -o-transform: rotateY(0deg);
  -ms-transform: rotateY(0deg);
  transform: rotateY(0deg);
}
.tagline > ul > li.vs-out {
  top: 85px;
  -webkit-transform: rotateX(-180deg);
  -moz-transform: rotateX(-180deg);
  -o-transform: rotateX(-180deg);
  -ms-transform: rotateX(-180deg);
  transform: rotateX(-180deg);
}
.nav-side > li > a {
  -webkit-border-radius: 0;
  border-radius: 0;
  color: #686868;
  -webkit-transition: 0.2s;
  -moz-transition: 0.2s;
  -o-transition: 0.2s;
  -ms-transition: 0.2s;
  transition: 0.2s;
  font-size: 17px;
}
.last-minute-rating {
  color: <?php echo $themecolor;?>;
  font-size: 20px;
}
.last-minute-rating .fa {
  margin-right: 8px;
}
.last-minute-title {
  font-size: 50px;
  line-height: 1em;
  font-weight: 300;
  margin-bottom: 5px;
}
.last-minute-date {
  margin-bottom: 5px;
  font-size: 20px;
  font-style: italic;
}
::selection {
  background: <?php echo $themecolor;?>;
  color: #fff;
}
.datepicker {
  padding: 4px;
  direction: ltr;
}
.datepicker-inline {
  width: 250px;
  border: 1px solid #ccc;
  padding: 10px 15px;
}
.datepicker.datepicker-rtl {
  direction: rtl;
}
.datepicker.datepicker-rtl table tr td span {
  float: right;
}
.datepicker-dropdown {
  top: 0;
  left: 0;
}
.datepicker-dropdown:before {
  content: '';
  display: inline-block;
  border-left: 7px solid transparent;
  border-right: 7px solid transparent;
  border-bottom: 7px solid #ccc;
  border-top: 0;
  border-bottom-color: rgba(0,0,0,0.2);
  position: absolute;
}
.datepicker-dropdown:after {
  content: '';
  display: inline-block;
  border-left: 6px solid transparent;
  border-right: 6px solid transparent;
  border-bottom: 6px solid #fff;
  border-top: 0;
  position: absolute;
}
.datepicker-dropdown.datepicker-orient-left:before {
  left: 6px;
}
.datepicker-dropdown.datepicker-orient-left:after {
  left: 7px;
}
.datepicker-dropdown.datepicker-orient-right:before {
  right: 6px;
}
.datepicker-dropdown.datepicker-orient-right:after {
  right: 7px;
}
.datepicker-dropdown.datepicker-orient-top:before {
  top: -7px;
}
.datepicker-dropdown.datepicker-orient-top:after {
  top: -6px;
}
.datepicker-dropdown.datepicker-orient-bottom:before {
  bottom: -7px;
  border-bottom: 0;
  border-top: 7px solid #999;
}
.datepicker-dropdown.datepicker-orient-bottom:after {
  bottom: -6px;
  border-bottom: 0;
  border-top: 6px solid #fff;
}
.datepicker > div {
  display: none;
}
.datepicker.days div.datepicker-days {
  display: block;
}
.datepicker.months div.datepicker-months {
  display: block;
}
.datepicker.years div.datepicker-years {
  display: block;
}
.datepicker table {
  margin: 0;
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
.datepicker table tr td,
.datepicker table tr th {
  text-align: center;
  width: 30px;
  height: 30px;
  border: none;
}
.table-striped .datepicker table tr td,
.table-striped .datepicker table tr th {
  background-color: transparent;
}
.datepicker table tr td.day:hover,
.datepicker table tr td.day.focused {
  background: #eee;
  cursor: pointer;
}
.datepicker table tr td.day {
  border: 1px solid #e6e6e6;
}
.datepicker table tr td.old,
.datepicker table tr td.new {
  color: #999;
}
.datepicker table tr td.disabled,
.datepicker table tr td.disabled:hover {
  background: none;
  color: #999;
  cursor: default;
}
.datepicker table tr td.today,
.datepicker table tr td.today:hover,
.datepicker table tr td.today.disabled,
.datepicker table tr td.today.disabled:hover {
  color: #000;
  position: relative;
}
.datepicker table tr td.today:before,
.datepicker table tr td.today:hover:before,
.datepicker table tr td.today.disabled:before,
.datepicker table tr td.today.disabled:hover:before {
  content: '';
  bottom: 2px;
  right: 2px;
  display: block;
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 0 0 7px 7px;
  border-color: transparent transparent <?php echo $themecolor;?> transparent;
  position: absolute;
}
.datepicker table tr td.today:active,
.datepicker table tr td.today:hover:active,
.datepicker table tr td.today.disabled:active,
.datepicker table tr td.today.disabled:hover:active,
.datepicker table tr td.today.active,
.datepicker table tr td.today:hover.active,
.datepicker table tr td.today.disabled.active,
.datepicker table tr td.today.disabled:hover.active,
.open .dropdown-toggle.datepicker table tr td.today,
.open .dropdown-toggle.datepicker table tr td.today:hover,
.open .dropdown-toggle.datepicker table tr td.today.disabled,
.open .dropdown-toggle.datepicker table tr td.today.disabled:hover {
  background-image: none;
}
.datepicker table tr td.today.disabled,
.datepicker table tr td.today:hover.disabled,
.datepicker table tr td.today.disabled.disabled,
.datepicker table tr td.today.disabled:hover.disabled,
.datepicker table tr td.today[disabled],
.datepicker table tr td.today:hover[disabled],
.datepicker table tr td.today.disabled[disabled],
.datepicker table tr td.today.disabled:hover[disabled],
fieldset[disabled] .datepicker table tr td.today,
fieldset[disabled] .datepicker table tr td.today:hover,
fieldset[disabled] .datepicker table tr td.today.disabled,
fieldset[disabled] .datepicker table tr td.today.disabled:hover,
.datepicker table tr td.today.disabled:hover,
.datepicker table tr td.today:hover.disabled:hover,
.datepicker table tr td.today.disabled.disabled:hover,
.datepicker table tr td.today.disabled:hover.disabled:hover,
.datepicker table tr td.today[disabled]:hover,
.datepicker table tr td.today:hover[disabled]:hover,
.datepicker table tr td.today.disabled[disabled]:hover,
.datepicker table tr td.today.disabled:hover[disabled]:hover,
fieldset[disabled] .datepicker table tr td.today:hover,
fieldset[disabled] .datepicker table tr td.today:hover:hover,
fieldset[disabled] .datepicker table tr td.today.disabled:hover,
fieldset[disabled] .datepicker table tr td.today.disabled:hover:hover,
.datepicker table tr td.today.disabled:focus,
.datepicker table tr td.today:hover.disabled:focus,
.datepicker table tr td.today.disabled.disabled:focus,
.datepicker table tr td.today.disabled:hover.disabled:focus,
.datepicker table tr td.today[disabled]:focus,
.datepicker table tr td.today:hover[disabled]:focus,
.datepicker table tr td.today.disabled[disabled]:focus,
.datepicker table tr td.today.disabled:hover[disabled]:focus,
fieldset[disabled] .datepicker table tr td.today:focus,
fieldset[disabled] .datepicker table tr td.today:hover:focus,
fieldset[disabled] .datepicker table tr td.today.disabled:focus,
fieldset[disabled] .datepicker table tr td.today.disabled:hover:focus,
.datepicker table tr td.today.disabled:active,
.datepicker table tr td.today:hover.disabled:active,
.datepicker table tr td.today.disabled.disabled:active,
.datepicker table tr td.today.disabled:hover.disabled:active,
.datepicker table tr td.today[disabled]:active,
.datepicker table tr td.today:hover[disabled]:active,
.datepicker table tr td.today.disabled[disabled]:active,
.datepicker table tr td.today.disabled:hover[disabled]:active,
fieldset[disabled] .datepicker table tr td.today:active,
fieldset[disabled] .datepicker table tr td.today:hover:active,
fieldset[disabled] .datepicker table tr td.today.disabled:active,
fieldset[disabled] .datepicker table tr td.today.disabled:hover:active,
.datepicker table tr td.today.disabled.active,
.datepicker table tr td.today:hover.disabled.active,
.datepicker table tr td.today.disabled.disabled.active,
.datepicker table tr td.today.disabled:hover.disabled.active,
.datepicker table tr td.today[disabled].active,
.datepicker table tr td.today:hover[disabled].active,
.datepicker table tr td.today.disabled[disabled].active,
.datepicker table tr td.today.disabled:hover[disabled].active,
fieldset[disabled] .datepicker table tr td.today.active,
fieldset[disabled] .datepicker table tr td.today:hover.active,
fieldset[disabled] .datepicker table tr td.today.disabled.active,
fieldset[disabled] .datepicker table tr td.today.disabled:hover.active {
  background-color: #ffdb99;
  border-color: #ffb733;
}
.datepicker table tr td.today:hover:hover {
  color: #000;
}
.datepicker table tr td.today.active:hover {
  color: #fff;
}
.datepicker table tr td.range,
.datepicker table tr td.range:hover,
.datepicker table tr td.range.disabled,
.datepicker table tr td.range.disabled:hover {
  background: #eee;
  -webkit-border-radius: 0;
  border-radius: 0;
}
.datepicker table tr td.range.today,
.datepicker table tr td.range.today:hover,
.datepicker table tr td.range.today.disabled,
.datepicker table tr td.range.today.disabled:hover {
  color: #000;
  background-color: #f7ca77;
  border-color: #f1a417;
  -webkit-border-radius: 0;
  border-radius: 0;
}
.datepicker table tr td.range.today:hover,
.datepicker table tr td.range.today:hover:hover,
.datepicker table tr td.range.today.disabled:hover,
.datepicker table tr td.range.today.disabled:hover:hover,
.datepicker table tr td.range.today:focus,
.datepicker table tr td.range.today:hover:focus,
.datepicker table tr td.range.today.disabled:focus,
.datepicker table tr td.range.today.disabled:hover:focus,
.datepicker table tr td.range.today:active,
.datepicker table tr td.range.today:hover:active,
.datepicker table tr td.range.today.disabled:active,
.datepicker table tr td.range.today.disabled:hover:active,
.datepicker table tr td.range.today.active,
.datepicker table tr td.range.today:hover.active,
.datepicker table tr td.range.today.disabled.active,
.datepicker table tr td.range.today.disabled:hover.active,
.open .dropdown-toggle.datepicker table tr td.range.today,
.open .dropdown-toggle.datepicker table tr td.range.today:hover,
.open .dropdown-toggle.datepicker table tr td.range.today.disabled,
.open .dropdown-toggle.datepicker table tr td.range.today.disabled:hover {
  color: #000;
  background-color: #f4bb51;
  border-color: #bf800c;
}
.datepicker table tr td.range.today:active,
.datepicker table tr td.range.today:hover:active,
.datepicker table tr td.range.today.disabled:active,
.datepicker table tr td.range.today.disabled:hover:active,
.datepicker table tr td.range.today.active,
.datepicker table tr td.range.today:hover.active,
.datepicker table tr td.range.today.disabled.active,
.datepicker table tr td.range.today.disabled:hover.active,
.open .dropdown-toggle.datepicker table tr td.range.today,
.open .dropdown-toggle.datepicker table tr td.range.today:hover,
.open .dropdown-toggle.datepicker table tr td.range.today.disabled,
.open .dropdown-toggle.datepicker table tr td.range.today.disabled:hover {
  background-image: none;
}
.datepicker table tr td.range.today.disabled,
.datepicker table tr td.range.today:hover.disabled,
.datepicker table tr td.range.today.disabled.disabled,
.datepicker table tr td.range.today.disabled:hover.disabled,
.datepicker table tr td.range.today[disabled],
.datepicker table tr td.range.today:hover[disabled],
.datepicker table tr td.range.today.disabled[disabled],
.datepicker table tr td.range.today.disabled:hover[disabled],
fieldset[disabled] .datepicker table tr td.range.today,
fieldset[disabled] .datepicker table tr td.range.today:hover,
fieldset[disabled] .datepicker table tr td.range.today.disabled,
fieldset[disabled] .datepicker table tr td.range.today.disabled:hover,
.datepicker table tr td.range.today.disabled:hover,
.datepicker table tr td.range.today:hover.disabled:hover,
.datepicker table tr td.range.today.disabled.disabled:hover,
.datepicker table tr td.range.today.disabled:hover.disabled:hover,
.datepicker table tr td.range.today[disabled]:hover,
.datepicker table tr td.range.today:hover[disabled]:hover,
.datepicker table tr td.range.today.disabled[disabled]:hover,
.datepicker table tr td.range.today.disabled:hover[disabled]:hover,
fieldset[disabled] .datepicker table tr td.range.today:hover,
fieldset[disabled] .datepicker table tr td.range.today:hover:hover,
fieldset[disabled] .datepicker table tr td.range.today.disabled:hover,
fieldset[disabled] .datepicker table tr td.range.today.disabled:hover:hover,
.datepicker table tr td.range.today.disabled:focus,
.datepicker table tr td.range.today:hover.disabled:focus,
.datepicker table tr td.range.today.disabled.disabled:focus,
.datepicker table tr td.range.today.disabled:hover.disabled:focus,
.datepicker table tr td.range.today[disabled]:focus,
.datepicker table tr td.range.today:hover[disabled]:focus,
.datepicker table tr td.range.today.disabled[disabled]:focus,
.datepicker table tr td.range.today.disabled:hover[disabled]:focus,
fieldset[disabled] .datepicker table tr td.range.today:focus,
fieldset[disabled] .datepicker table tr td.range.today:hover:focus,
fieldset[disabled] .datepicker table tr td.range.today.disabled:focus,
fieldset[disabled] .datepicker table tr td.range.today.disabled:hover:focus,
.datepicker table tr td.range.today.disabled:active,
.datepicker table tr td.range.today:hover.disabled:active,
.datepicker table tr td.range.today.disabled.disabled:active,
.datepicker table tr td.range.today.disabled:hover.disabled:active,
.datepicker table tr td.range.today[disabled]:active,
.datepicker table tr td.range.today:hover[disabled]:active,
.datepicker table tr td.range.today.disabled[disabled]:active,
.datepicker table tr td.range.today.disabled:hover[disabled]:active,
fieldset[disabled] .datepicker table tr td.range.today:active,
fieldset[disabled] .datepicker table tr td.range.today:hover:active,
fieldset[disabled] .datepicker table tr td.range.today.disabled:active,
fieldset[disabled] .datepicker table tr td.range.today.disabled:hover:active,
.datepicker table tr td.range.today.disabled.active,
.datepicker table tr td.range.today:hover.disabled.active,
.datepicker table tr td.range.today.disabled.disabled.active,
.datepicker table tr td.range.today.disabled:hover.disabled.active,
.datepicker table tr td.range.today[disabled].active,
.datepicker table tr td.range.today:hover[disabled].active,
.datepicker table tr td.range.today.disabled[disabled].active,
.datepicker table tr td.range.today.disabled:hover[disabled].active,
fieldset[disabled] .datepicker table tr td.range.today.active,
fieldset[disabled] .datepicker table tr td.range.today:hover.active,
fieldset[disabled] .datepicker table tr td.range.today.disabled.active,
fieldset[disabled] .datepicker table tr td.range.today.disabled:hover.active {
  background-color: #f7ca77;
  border-color: #f1a417;
}
.datepicker table tr td.selected,
.datepicker table tr td.selected:hover,
.datepicker table tr td.selected.disabled,
.datepicker table tr td.selected.disabled:hover {
  color: #fff;
  background-color: #999;
  border-color: #555;
  text-shadow: 0 -1px 0 rgba(0,0,0,0.25);
}
.datepicker table tr td.selected:hover,
.datepicker table tr td.selected:hover:hover,
.datepicker table tr td.selected.disabled:hover,
.datepicker table tr td.selected.disabled:hover:hover,
.datepicker table tr td.selected:focus,
.datepicker table tr td.selected:hover:focus,
.datepicker table tr td.selected.disabled:focus,
.datepicker table tr td.selected.disabled:hover:focus,
.datepicker table tr td.selected:active,
.datepicker table tr td.selected:hover:active,
.datepicker table tr td.selected.disabled:active,
.datepicker table tr td.selected.disabled:hover:active,
.datepicker table tr td.selected.active,
.datepicker table tr td.selected:hover.active,
.datepicker table tr td.selected.disabled.active,
.datepicker table tr td.selected.disabled:hover.active,
.open .dropdown-toggle.datepicker table tr td.selected,
.open .dropdown-toggle.datepicker table tr td.selected:hover,
.open .dropdown-toggle.datepicker table tr td.selected.disabled,
.open .dropdown-toggle.datepicker table tr td.selected.disabled:hover {
  border-color: #373737;
}
.datepicker table tr td.selected:hover color: #ffffff,
.datepicker table tr td.selected:hover:hover color: #ffffff,
.datepicker table tr td.selected.disabled:hover color: #ffffff,
.datepicker table tr td.selected.disabled:hover:hover color: #ffffff,
.datepicker table tr td.selected:focus color: #ffffff,
.datepicker table tr td.selected:hover:focus color: #ffffff,
.datepicker table tr td.selected.disabled:focus color: #ffffff,
.datepicker table tr td.selected.disabled:hover:focus color: #ffffff,
.datepicker table tr td.selected:active color: #ffffff,
.datepicker table tr td.selected:hover:active color: #ffffff,
.datepicker table tr td.selected.disabled:active color: #ffffff,
.datepicker table tr td.selected.disabled:hover:active color: #ffffff,
.datepicker table tr td.selected.active color: #ffffff,
.datepicker table tr td.selected:hover.active color: #ffffff,
.datepicker table tr td.selected.disabled.active color: #ffffff,
.datepicker table tr td.selected.disabled:hover.active color: #ffffff,
.open .dropdown-toggle.datepicker table tr td.selected color: #ffffff,
.open .dropdown-toggle.datepicker table tr td.selected:hover color: #ffffff,
.open .dropdown-toggle.datepicker table tr td.selected.disabled color: #ffffff,
.open .dropdown-toggle.datepicker table tr td.selected.disabled:hover color: #ffffff {
  background-color: #858585;
}
.datepicker table tr td.selected:active,
.datepicker table tr td.selected:hover:active,
.datepicker table tr td.selected.disabled:active,
.datepicker table tr td.selected.disabled:hover:active,
.datepicker table tr td.selected.active,
.datepicker table tr td.selected:hover.active,
.datepicker table tr td.selected.disabled.active,
.datepicker table tr td.selected.disabled:hover.active,
.open .dropdown-toggle.datepicker table tr td.selected,
.open .dropdown-toggle.datepicker table tr td.selected:hover,
.open .dropdown-toggle.datepicker table tr td.selected.disabled,
.open .dropdown-toggle.datepicker table tr td.selected.disabled:hover {
  background-image: none;
}
.datepicker table tr td.selected.disabled,
.datepicker table tr td.selected:hover.disabled,
.datepicker table tr td.selected.disabled.disabled,
.datepicker table tr td.selected.disabled:hover.disabled,
.datepicker table tr td.selected[disabled],
.datepicker table tr td.selected:hover[disabled],
.datepicker table tr td.selected.disabled[disabled],
.datepicker table tr td.selected.disabled:hover[disabled],
fieldset[disabled] .datepicker table tr td.selected,
fieldset[disabled] .datepicker table tr td.selected:hover,
fieldset[disabled] .datepicker table tr td.selected.disabled,
fieldset[disabled] .datepicker table tr td.selected.disabled:hover,
.datepicker table tr td.selected.disabled:hover,
.datepicker table tr td.selected:hover.disabled:hover,
.datepicker table tr td.selected.disabled.disabled:hover,
.datepicker table tr td.selected.disabled:hover.disabled:hover,
.datepicker table tr td.selected[disabled]:hover,
.datepicker table tr td.selected:hover[disabled]:hover,
.datepicker table tr td.selected.disabled[disabled]:hover,
.datepicker table tr td.selected.disabled:hover[disabled]:hover,
fieldset[disabled] .datepicker table tr td.selected:hover,
fieldset[disabled] .datepicker table tr td.selected:hover:hover,
fieldset[disabled] .datepicker table tr td.selected.disabled:hover,
fieldset[disabled] .datepicker table tr td.selected.disabled:hover:hover,
.datepicker table tr td.selected.disabled:focus,
.datepicker table tr td.selected:hover.disabled:focus,
.datepicker table tr td.selected.disabled.disabled:focus,
.datepicker table tr td.selected.disabled:hover.disabled:focus,
.datepicker table tr td.selected[disabled]:focus,
.datepicker table tr td.selected:hover[disabled]:focus,
.datepicker table tr td.selected.disabled[disabled]:focus,
.datepicker table tr td.selected.disabled:hover[disabled]:focus,
fieldset[disabled] .datepicker table tr td.selected:focus,
fieldset[disabled] .datepicker table tr td.selected:hover:focus,
fieldset[disabled] .datepicker table tr td.selected.disabled:focus,
fieldset[disabled] .datepicker table tr td.selected.disabled:hover:focus,
.datepicker table tr td.selected.disabled:active,
.datepicker table tr td.selected:hover.disabled:active,
.datepicker table tr td.selected.disabled.disabled:active,
.datepicker table tr td.selected.disabled:hover.disabled:active,
.datepicker table tr td.selected[disabled]:active,
.datepicker table tr td.selected:hover[disabled]:active,
.datepicker table tr td.selected.disabled[disabled]:active,
.datepicker table tr td.selected.disabled:hover[disabled]:active,
fieldset[disabled] .datepicker table tr td.selected:active,
fieldset[disabled] .datepicker table tr td.selected:hover:active,
fieldset[disabled] .datepicker table tr td.selected.disabled:active,
fieldset[disabled] .datepicker table tr td.selected.disabled:hover:active,
.datepicker table tr td.selected.disabled.active,
.datepicker table tr td.selected:hover.disabled.active,
.datepicker table tr td.selected.disabled.disabled.active,
.datepicker table tr td.selected.disabled:hover.disabled.active,
.datepicker table tr td.selected[disabled].active,
.datepicker table tr td.selected:hover[disabled].active,
.datepicker table tr td.selected.disabled[disabled].active,
.datepicker table tr td.selected.disabled:hover[disabled].active,
fieldset[disabled] .datepicker table tr td.selected.active,
fieldset[disabled] .datepicker table tr td.selected:hover.active,
fieldset[disabled] .datepicker table tr td.selected.disabled.active,
fieldset[disabled] .datepicker table tr td.selected.disabled:hover.active {
  background-color: #999;
  border-color: #555;
}
.datepicker table tr td.active,
.datepicker table tr td.active:hover,
.datepicker table tr td.active.disabled,
.datepicker table tr td.active.disabled:hover {
  color: #fff;
  background-color: <?php echo $themecolordark;?>;
  border-color: #357ebd;
  text-shadow: 0 -1px 0 rgba(0,0,0,0.25);
}
.datepicker table tr td.active:hover,
.datepicker table tr td.active:hover:hover,
.datepicker table tr td.active.disabled:hover,
.datepicker table tr td.active.disabled:hover:hover,
.datepicker table tr td.active:focus,
.datepicker table tr td.active:hover:focus,
.datepicker table tr td.active.disabled:focus,
.datepicker table tr td.active.disabled:hover:focus,
.datepicker table tr td.active:active,
.datepicker table tr td.active:hover:active,
.datepicker table tr td.active.disabled:active,
.datepicker table tr td.active.disabled:hover:active,
.datepicker table tr td.active.active,
.datepicker table tr td.active:hover.active,
.datepicker table tr td.active.disabled.active,
.datepicker table tr td.active.disabled:hover.active,
.open .dropdown-toggle.datepicker table tr td.active,
.open .dropdown-toggle.datepicker table tr td.active:hover,
.open .dropdown-toggle.datepicker table tr td.active.disabled,
.open .dropdown-toggle.datepicker table tr td.active.disabled:hover {
  color: #fff;
  background-color: <?php echo $themecolor;?>;
  border-color: <?php echo $themecolordark;?>;
}
.datepicker table tr td.active:active,
.datepicker table tr td.active:hover:active,
.datepicker table tr td.active.disabled:active,
.datepicker table tr td.active.disabled:hover:active,
.datepicker table tr td.active.active,
.datepicker table tr td.active:hover.active,
.datepicker table tr td.active.disabled.active,
.datepicker table tr td.active.disabled:hover.active,
.open .dropdown-toggle.datepicker table tr td.active,
.open .dropdown-toggle.datepicker table tr td.active:hover,
.open .dropdown-toggle.datepicker table tr td.active.disabled,
.open .dropdown-toggle.datepicker table tr td.active.disabled:hover {
  background-image: none;
}
.datepicker table tr td.active.disabled,
.datepicker table tr td.active:hover.disabled,
.datepicker table tr td.active.disabled.disabled,
.datepicker table tr td.active.disabled:hover.disabled,
.datepicker table tr td.active[disabled],
.datepicker table tr td.active:hover[disabled],
.datepicker table tr td.active.disabled[disabled],
.datepicker table tr td.active.disabled:hover[disabled],
fieldset[disabled] .datepicker table tr td.active,
fieldset[disabled] .datepicker table tr td.active:hover,
fieldset[disabled] .datepicker table tr td.active.disabled,
fieldset[disabled] .datepicker table tr td.active.disabled:hover,
.datepicker table tr td.active.disabled:hover,
.datepicker table tr td.active:hover.disabled:hover,
.datepicker table tr td.active.disabled.disabled:hover,
.datepicker table tr td.active.disabled:hover.disabled:hover,
.datepicker table tr td.active[disabled]:hover,
.datepicker table tr td.active:hover[disabled]:hover,
.datepicker table tr td.active.disabled[disabled]:hover,
.datepicker table tr td.active.disabled:hover[disabled]:hover,
fieldset[disabled] .datepicker table tr td.active:hover,
fieldset[disabled] .datepicker table tr td.active:hover:hover,
fieldset[disabled] .datepicker table tr td.active.disabled:hover,
fieldset[disabled] .datepicker table tr td.active.disabled:hover:hover,
.datepicker table tr td.active.disabled:focus,
.datepicker table tr td.active:hover.disabled:focus,
.datepicker table tr td.active.disabled.disabled:focus,
.datepicker table tr td.active.disabled:hover.disabled:focus,
.datepicker table tr td.active[disabled]:focus,
.datepicker table tr td.active:hover[disabled]:focus,
.datepicker table tr td.active.disabled[disabled]:focus,
.datepicker table tr td.active.disabled:hover[disabled]:focus,
fieldset[disabled] .datepicker table tr td.active:focus,
fieldset[disabled] .datepicker table tr td.active:hover:focus,
fieldset[disabled] .datepicker table tr td.active.disabled:focus,
fieldset[disabled] .datepicker table tr td.active.disabled:hover:focus,
.datepicker table tr td.active.disabled:active,
.datepicker table tr td.active:hover.disabled:active,
.datepicker table tr td.active.disabled.disabled:active,
.datepicker table tr td.active.disabled:hover.disabled:active,
.datepicker table tr td.active[disabled]:active,
.datepicker table tr td.active:hover[disabled]:active,
.datepicker table tr td.active.disabled[disabled]:active,
.datepicker table tr td.active.disabled:hover[disabled]:active,
fieldset[disabled] .datepicker table tr td.active:active,
fieldset[disabled] .datepicker table tr td.active:hover:active,
fieldset[disabled] .datepicker table tr td.active.disabled:active,
fieldset[disabled] .datepicker table tr td.active.disabled:hover:active,
.datepicker table tr td.active.disabled.active,
.datepicker table tr td.active:hover.disabled.active,
.datepicker table tr td.active.disabled.disabled.active,
.datepicker table tr td.active.disabled:hover.disabled.active,
.datepicker table tr td.active[disabled].active,
.datepicker table tr td.active:hover[disabled].active,
.datepicker table tr td.active.disabled[disabled].active,
.datepicker table tr td.active.disabled:hover[disabled].active,
fieldset[disabled] .datepicker table tr td.active.active,
fieldset[disabled] .datepicker table tr td.active:hover.active,
fieldset[disabled] .datepicker table tr td.active.disabled.active,
fieldset[disabled] .datepicker table tr td.active.disabled:hover.active {
  background-color: <?php echo $themecolordark;?>;
  border-color: #357ebd;
}
.datepicker table tr td span {
  display: block;
  width: 23%;
  height: 54px;
  line-height: 54px;
  float: left;
  margin: 1%;
  cursor: pointer;
}
.datepicker table tr td span:hover {
  background: #eee;
}
.datepicker table tr td span.disabled,
.datepicker table tr td span.disabled:hover {
  background: none;
  color: #999;
  cursor: default;
}
.datepicker table tr td span.active,
.datepicker table tr td span.active:hover,
.datepicker table tr td span.active.disabled,
.datepicker table tr td span.active.disabled:hover {
  color: #fff;
  background-color: <?php echo $themecolordark;?>;
  border-color: #357ebd;
  text-shadow: 0 -1px 0 rgba(0,0,0,0.25);
}
.datepicker table tr td span.active:hover,
.datepicker table tr td span.active:hover:hover,
.datepicker table tr td span.active.disabled:hover,
.datepicker table tr td span.active.disabled:hover:hover,
.datepicker table tr td span.active:focus,
.datepicker table tr td span.active:hover:focus,
.datepicker table tr td span.active.disabled:focus,
.datepicker table tr td span.active.disabled:hover:focus,
.datepicker table tr td span.active:active,
.datepicker table tr td span.active:hover:active,
.datepicker table tr td span.active.disabled:active,
.datepicker table tr td span.active.disabled:hover:active,
.datepicker table tr td span.active.active,
.datepicker table tr td span.active:hover.active,
.datepicker table tr td span.active.disabled.active,
.datepicker table tr td span.active.disabled:hover.active,
.open .dropdown-toggle.datepicker table tr td span.active,
.open .dropdown-toggle.datepicker table tr td span.active:hover,
.open .dropdown-toggle.datepicker table tr td span.active.disabled,
.open .dropdown-toggle.datepicker table tr td span.active.disabled:hover {
  color: #fff;
  background-color: <?php echo $themecolor;?>;
  border-color: <?php echo $themecolordark;?>;
}
.datepicker table tr td span.active:active,
.datepicker table tr td span.active:hover:active,
.datepicker table tr td span.active.disabled:active,
.datepicker table tr td span.active.disabled:hover:active,
.datepicker table tr td span.active.active,
.datepicker table tr td span.active:hover.active,
.datepicker table tr td span.active.disabled.active,
.datepicker table tr td span.active.disabled:hover.active,
.open .dropdown-toggle.datepicker table tr td span.active,
.open .dropdown-toggle.datepicker table tr td span.active:hover,
.open .dropdown-toggle.datepicker table tr td span.active.disabled,
.open .dropdown-toggle.datepicker table tr td span.active.disabled:hover {
  background-image: none;
}
.datepicker table tr td span.active.disabled,
.datepicker table tr td span.active:hover.disabled,
.datepicker table tr td span.active.disabled.disabled,
.datepicker table tr td span.active.disabled:hover.disabled,
.datepicker table tr td span.active[disabled],
.datepicker table tr td span.active:hover[disabled],
.datepicker table tr td span.active.disabled[disabled],
.datepicker table tr td span.active.disabled:hover[disabled],
fieldset[disabled] .datepicker table tr td span.active,
fieldset[disabled] .datepicker table tr td span.active:hover,
fieldset[disabled] .datepicker table tr td span.active.disabled,
fieldset[disabled] .datepicker table tr td span.active.disabled:hover,
.datepicker table tr td span.active.disabled:hover,
.datepicker table tr td span.active:hover.disabled:hover,
.datepicker table tr td span.active.disabled.disabled:hover,
.datepicker table tr td span.active.disabled:hover.disabled:hover,
.datepicker table tr td span.active[disabled]:hover,
.datepicker table tr td span.active:hover[disabled]:hover,
.datepicker table tr td span.active.disabled[disabled]:hover,
.datepicker table tr td span.active.disabled:hover[disabled]:hover,
fieldset[disabled] .datepicker table tr td span.active:hover,
fieldset[disabled] .datepicker table tr td span.active:hover:hover,
fieldset[disabled] .datepicker table tr td span.active.disabled:hover,
fieldset[disabled] .datepicker table tr td span.active.disabled:hover:hover,
.datepicker table tr td span.active.disabled:focus,
.datepicker table tr td span.active:hover.disabled:focus,
.datepicker table tr td span.active.disabled.disabled:focus,
.datepicker table tr td span.active.disabled:hover.disabled:focus,
.datepicker table tr td span.active[disabled]:focus,
.datepicker table tr td span.active:hover[disabled]:focus,
.datepicker table tr td span.active.disabled[disabled]:focus,
.datepicker table tr td span.active.disabled:hover[disabled]:focus,
fieldset[disabled] .datepicker table tr td span.active:focus,
fieldset[disabled] .datepicker table tr td span.active:hover:focus,
fieldset[disabled] .datepicker table tr td span.active.disabled:focus,
fieldset[disabled] .datepicker table tr td span.active.disabled:hover:focus,
.datepicker table tr td span.active.disabled:active,
.datepicker table tr td span.active:hover.disabled:active,
.datepicker table tr td span.active.disabled.disabled:active,
.datepicker table tr td span.active.disabled:hover.disabled:active,
.datepicker table tr td span.active[disabled]:active,
.datepicker table tr td span.active:hover[disabled]:active,
.datepicker table tr td span.active.disabled[disabled]:active,
.datepicker table tr td span.active.disabled:hover[disabled]:active,
fieldset[disabled] .datepicker table tr td span.active:active,
fieldset[disabled] .datepicker table tr td span.active:hover:active,
fieldset[disabled] .datepicker table tr td span.active.disabled:active,
fieldset[disabled] .datepicker table tr td span.active.disabled:hover:active,
.datepicker table tr td span.active.disabled.active,
.datepicker table tr td span.active:hover.disabled.active,
.datepicker table tr td span.active.disabled.disabled.active,
.datepicker table tr td span.active.disabled:hover.disabled.active,
.datepicker table tr td span.active[disabled].active,
.datepicker table tr td span.active:hover[disabled].active,
.datepicker table tr td span.active.disabled[disabled].active,
.datepicker table tr td span.active.disabled:hover[disabled].active,
fieldset[disabled] .datepicker table tr td span.active.active,
fieldset[disabled] .datepicker table tr td span.active:hover.active,
fieldset[disabled] .datepicker table tr td span.active.disabled.active,
fieldset[disabled] .datepicker table tr td span.active.disabled:hover.active {
  background-color: <?php echo $themecolordark;?>;
  border-color: #357ebd;
}
.datepicker table tr td span.old,
.datepicker table tr td span.new {
  color: #999;
}
.datepicker th.datepicker-switch {
  width: 145px;
}
.datepicker thead tr:first-child th,
.datepicker tfoot tr th {
  cursor: pointer;
}
.datepicker thead tr:first-child th:hover,
.datepicker tfoot tr th:hover {
  background: #eee;
}
.datepicker .cw {
  font-size: 10px;
  width: 12px;
  padding: 0 2px 0 5px;
  vertical-align: middle;
}
.datepicker thead tr:first-child th.cw {
  cursor: default;
  background-color: transparent;
}
.input-group.date .input-group-addon i {
  cursor: pointer;
  width: 16px;
  height: 16px;
}
.input-daterange .input-group-addon {
  width: auto;
  min-width: 16px;
  padding: 4px 5px;
  font-weight: normal;
  line-height: 1.428571429;
  text-align: center;
  text-shadow: 0 1px 0 #fff;
  vertical-align: middle;
  background-color: #eee;
  border: solid #ccc;
  border-width: 1px 0;
  margin-left: -5px;
  margin-right: -5px;
}
.datepicker.dropdown-menu {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  float: left;
  display: none;
  min-width: 160px;
  list-style: none;
  background-color: #fff;
  border: 1px solid rgba(0,0,0,0.2);
  -webkit-border-radius: 0;
  border-radius: 0;
  -webkit-background-clip: padding-box;
  -moz-background-clip: padding;
  -webkit-background-clip: padding;
  -moz-background-clip: padding;
  background-clip: padding-box;
  *border-right-width: 2px;
  *border-bottom-width: 2px;
  color: #333;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 13px;
  line-height: 1.428571429;
  -webkit-box-shadow: 0 2px 1px rgba(0,0,0,0.2);
  box-shadow: 0 2px 1px rgba(0,0,0,0.2);
  padding: 7px 10px;
}
.datepicker.dropdown-menu th,
.datepicker.datepicker-inline th,
.datepicker.dropdown-menu td,
.datepicker.datepicker-inline td {
  padding: 0px 5px;
}
.datepicker thead tr:first-child th.prev:before,
.datepicker thead tr:first-child th.next:before {
  font-family: 'FontAwesome';
  content: '\f105';
  font-size: 18px;
}
.datepicker thead tr:first-child th.prev:before {
  content: '\f104';
}
.bootstrap-timepicker {
  position: relative;
}
.bootstrap-timepicker.pull-right .bootstrap-timepicker-widget.dropdown-menu {
  left: auto;
  right: 0;
}
.bootstrap-timepicker.pull-right .bootstrap-timepicker-widget.dropdown-menu:before {
  left: auto;
  right: 12px;
}
.bootstrap-timepicker.pull-right .bootstrap-timepicker-widget.dropdown-menu:after {
  left: auto;
  right: 13px;
}
.bootstrap-timepicker .add-on {
  cursor: pointer;
}
.bootstrap-timepicker .add-on i {
  display: inline-block;
  width: 16px;
  height: 16px;
  border: 1px solid rgba(0,0,0,0.2);
}
.bootstrap-timepicker-widget.dropdown-menu {
  padding: 7px 10px;
  -webkit-border-radius: 0;
  border-radius: 0;
  -webkit-box-shadow: 0 2px 1px rgba(0,0,0,0.2);
  box-shadow: 0 2px 1px rgba(0,0,0,0.2);
}
.bootstrap-timepicker-widget.dropdown-menu.open {
  display: inline-block;
}
.bootstrap-timepicker-widget.dropdown-menu:before {
  border-bottom: 7px solid rgba(0,0,0,0.2);
  border-left: 7px solid transparent;
  border-right: 7px solid transparent;
  content: "";
  display: inline-block;
  position: absolute;
}
.bootstrap-timepicker-widget.dropdown-menu:after {
  border-bottom: 6px solid #fff;
  border-left: 6px solid transparent;
  border-right: 6px solid transparent;
  content: "";
  display: inline-block;
  position: absolute;
}
.bootstrap-timepicker-widget.timepicker-orient-left:before {
  left: 6px;
}
.bootstrap-timepicker-widget.timepicker-orient-left:after {
  left: 7px;
}
.bootstrap-timepicker-widget.timepicker-orient-right:before {
  right: 6px;
}
.bootstrap-timepicker-widget.timepicker-orient-right:after {
  right: 7px;
}
.bootstrap-timepicker-widget.timepicker-orient-top:before {
  top: -7px;
}
.bootstrap-timepicker-widget.timepicker-orient-top:after {
  top: -6px;
}
.bootstrap-timepicker-widget.timepicker-orient-bottom:before {
  bottom: -7px;
  border-bottom: 0;
  border-top: 7px solid #999;
}
.bootstrap-timepicker-widget.timepicker-orient-bottom:after {
  bottom: -6px;
  border-bottom: 0;
  border-top: 6px solid #fff;
}
.bootstrap-timepicker-widget a.btn,
.bootstrap-timepicker-widget input {
  -webkit-border-radius: 0;
  border-radius: 0;
}
.bootstrap-timepicker-widget table {
  width: 100%;
  margin: 0;
}
.bootstrap-timepicker-widget table td {
  text-align: center;
  height: 30px;
  margin: 0;
  padding: 2px;
}
.bootstrap-timepicker-widget table td:not(.separator) {
  min-width: 30px;
}
.bootstrap-timepicker-widget table td span {
  width: 100%;
}
.bootstrap-timepicker-widget table td a {
  width: 100%;
  display: inline-block;
  margin: 0;
  outline: 0;
  color: #333;
  width: 35px;
  height: 35px;
  line-height: 35px;
}
.bootstrap-timepicker-widget table td a:hover {
  text-decoration: none;
  background-color: #eee;
}
.bootstrap-timepicker-widget table td a i {
  margin-top: 2px;
  font-size: 18px;
}
.bootstrap-timepicker-widget table td input {
  width: 35px;
  margin: 0;
  text-align: center;
  color: #000;
}
.bootstrap-timepicker-widget .modal-content {
  padding: 4px;
}
@media (min-width: 767px) {
  .bootstrap-timepicker-widget.modal {
    width: 200px;
    margin-left: -100px;
  }
}
@media (max-width: 767px) {
  .bootstrap-timepicker {
    width: 100%;
  }
  .bootstrap-timepicker .dropdown-menu {
    width: 100%;
  }
}
.cc-form .form-group {
  float: left;
}
.cc-form .form-group.form-group-cc-number,
.cc-form .form-group.form-group-cc-name {
  width: 60%;
  margin-right: 5%;
}
.cc-form .form-group.form-group-cc-date,
.cc-form .form-group.form-group-cc-cvc {
  width: 25%;
}
.cc-form .form-group.form-group-cc-number .cc-card-icon {
  display: block;
  width: 41px;
  height: 26px;
  position: absolute;
  right: 4px;
  top: 34px;
  background-repeat: no-repeat;
  -webkit-background-size: 100% 100%;
  -moz-background-size: 100% 100%;
  background-size: 100% 100%;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
  -webkit-transform: translate3d(0, -10px, 0);
  -moz-transform: translate3d(0, -10px, 0);
  -o-transform: translate3d(0, -10px, 0);
  -ms-transform: translate3d(0, -10px, 0);
  transform: translate3d(0, -10px, 0);
}
.cc-form .form-group.form-group-cc-number input.identified + .cc-card-icon {
  -webkit-transform: translate3d(0, 0, 0);
  -moz-transform: translate3d(0, 0, 0);
  -o-transform: translate3d(0, 0, 0);
  -ms-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
  opacity: 1;
  -ms-filter: none;
  filter: none;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
.cc-form .form-group.form-group-cc-number input.visa + .cc-card-icon {
  background-image: url("../img/payment/visa-curved-32px.png");
}
.cc-form .form-group.form-group-cc-number input.mastercard + .cc-card-icon {
  background-image: url("../img/payment/mastercard-curved-32px.png");
}
.cc-form .form-group.form-group-cc-number input.amex  + .cc-card-icon {
  background-image: url("../img/payment/american-express-curved-32px.png");
}
.cc-form .form-group.form-group-cc-number input.discover + .cc-card-icon {
  background-image: url("../img/payment/discover-curved-32px.png");
}
.cc-form .form-group.form-group-cc-number input.maestro + .cc-card-icon {
  background-image: url("../img/payment/maestro-curved-32px.png");
}
.icon-list {
  list-style: none;
  padding: 0;
}
.icon-list .fa {
  margin-right: 7px;
}
.icon-list-inline {
  margin-bottom: 0;
}
.icon-list-inline > li {
  display: inline-block;
  margin-right: 3px;
}
.icon-list-inline > li:last-child {
  margin-right: 0;
}
.icon-list-inline .fa {
  margin-right: 0;
}
.icon-group {
  list-style: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
}
.icon-group > li {
  float: left;
  margin-right: 5px;
}
.icon-group > li:last-child {
  margin-right: 0;
}
.box-icon,
[class^="box-icon-"],
[class*=" box-icon-"] {
  z-index: 2;
  position: relative;
  width: 30px;
  height: 30px;
  line-height: 30px;
  text-align: center;
  display: block;
  background: <?php echo $themecolor;?>;
  color: #fff;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
.box-icon:hover,
[class^="box-icon-"]:hover,
[class*=" box-icon-"]:hover {
  background: <?php echo $themecolordark;?>;
  color: #fff;
}
.box-icon:before,
[class^="box-icon-"]:before,
[class*=" box-icon-"]:before {
  display: inline-block;
}
.box-icon-inline {
  display: inline-block;
}
.box-icon-md {
  width: 45px;
  height: 45px;
  line-height: 45px;
  font-size: 21px;
}
.box-icon-big {
  width: 60px;
  height: 60px;
  line-height: 60px;
  font-size: 28px;
}
.box-icon-large {
  width: 90px;
  height: 90px;
  line-height: 90px;
  font-size: 42px;
}
.box-icon-huge {
  width: 120px;
  height: 120px;
  line-height: 120px;
  font-size: 56px;
}
.box-icon-black {
  background: #333;
}
.box-icon-black:hover {
  background: #000;
}
.box-icon-gray {
  background: #808080;
}
.box-icon-gray:hover {
  background: #4d4d4d;
}
.box-icon-white {
  background: #fff;
  color: <?php echo $themecolor;?>;
}
.box-icon-white:hover {
  color: <?php echo $themecolor;?>;
  background: #e6e6e6;
}
.box-icon-info {
  background: #2f96b4;
}
.box-icon-info:hover {
  background: #267890;
}
.box-icon-success {
  background: #51a351;
}
.box-icon-success:hover {
  background: #418241;
}
.box-icon-warning {
  background: #f89406;
}
.box-icon-warning:hover {
  background: #c67605;
}
.box-icon-danger {
  background: #bd362f;
}
.box-icon-danger:hover {
  background: #972b26;
}
.box-icon-inverse {
  background: #127cdc;
}
.box-icon-inverse:hover {
  background: #0e63b0;
}
.box-icon-to-normal:hover {
  background: <?php echo $themecolor;?>;
}
.box-icon-to-black:hover {
  background: #333;
}
.box-icon-to-gray:hover {
  background: #808080;
}
.box-icon-to-white:hover {
  background: #fff;
  color: <?php echo $themecolor;?>;
}
.box-icon-to-info:hover {
  background: #2f96b4;
}
.box-icon-to-success:hover {
  background: #51a351;
}
.box-icon-to-warning:hover {
  background: #f89406;
}
.box-icon-to-danger:hover {
  background: #bd362f;
}
.box-icon-to-inverse:hover {
  background: #127cdc;
}
.box-icon-border,
[class^="box-icon-border"],
[class*=" box-icon-border"] {
  background: none;
  border: 1px solid <?php echo $themecolor;?>;
  color: <?php echo $themecolor;?>;
}
.box-icon-border:hover,
[class^="box-icon-border"]:hover,
[class*=" box-icon-border"]:hover {
  background: <?php echo $themecolor;?>;
  color: #fff !important;
}
.box-icon-border.box-icon-black,
[class^="box-icon-border"].box-icon-black,
[class*=" box-icon-border"].box-icon-black,
.box-icon-border.box-icon-to-black:hover,
[class^="box-icon-border"].box-icon-to-black:hover,
[class*=" box-icon-border"].box-icon-to-black:hover {
  border-color: #333;
  color: #333;
}
.box-icon-border.box-icon-black:hover,
[class^="box-icon-border"].box-icon-black:hover,
[class*=" box-icon-border"].box-icon-black:hover,
.box-icon-border.box-icon-to-black:hover:hover,
[class^="box-icon-border"].box-icon-to-black:hover:hover,
[class*=" box-icon-border"].box-icon-to-black:hover:hover {
  background: #333;
}
.box-icon-border.box-icon-gray,
[class^="box-icon-border"].box-icon-gray,
[class*=" box-icon-border"].box-icon-gray,
.box-icon-border.box-icon-to-gray:hover,
[class^="box-icon-border"].box-icon-to-gray:hover,
[class*=" box-icon-border"].box-icon-to-gray:hover {
  border-color: #808080;
  color: #808080;
}
.box-icon-border.box-icon-gray:hover,
[class^="box-icon-border"].box-icon-gray:hover,
[class*=" box-icon-border"].box-icon-gray:hover,
.box-icon-border.box-icon-to-gray:hover:hover,
[class^="box-icon-border"].box-icon-to-gray:hover:hover,
[class*=" box-icon-border"].box-icon-to-gray:hover:hover {
  background: #808080;
}
.box-icon-border.box-icon-white,
[class^="box-icon-border"].box-icon-white,
[class*=" box-icon-border"].box-icon-white,
.box-icon-border.box-icon-to-white:hover,
[class^="box-icon-border"].box-icon-to-white:hover,
[class*=" box-icon-border"].box-icon-to-white:hover {
  border-color: #fff;
  color: #fff;
}
.box-icon-border.box-icon-white:hover,
[class^="box-icon-border"].box-icon-white:hover,
[class*=" box-icon-border"].box-icon-white:hover,
.box-icon-border.box-icon-to-white:hover:hover,
[class^="box-icon-border"].box-icon-to-white:hover:hover,
[class*=" box-icon-border"].box-icon-to-white:hover:hover {
  color: <?php echo $themecolor;?> !important;
  background: #fff;
}
.box-icon-border.box-icon-info,
[class^="box-icon-border"].box-icon-info,
[class*=" box-icon-border"].box-icon-info,
.box-icon-border.box-icon-to-info:hover,
[class^="box-icon-border"].box-icon-to-info:hover,
[class*=" box-icon-border"].box-icon-to-info:hover {
  border-color: #2f96b4;
  color: #2f96b4;
}
.box-icon-border.box-icon-info:hover,
[class^="box-icon-border"].box-icon-info:hover,
[class*=" box-icon-border"].box-icon-info:hover,
.box-icon-border.box-icon-to-info:hover:hover,
[class^="box-icon-border"].box-icon-to-info:hover:hover,
[class*=" box-icon-border"].box-icon-to-info:hover:hover {
  background: #2f96b4;
}
.box-icon-border.box-icon-success,
[class^="box-icon-border"].box-icon-success,
[class*=" box-icon-border"].box-icon-success,
.box-icon-border.box-icon-to-success:hover,
[class^="box-icon-border"].box-icon-to-success:hover,
[class*=" box-icon-border"].box-icon-to-success:hover {
  border-color: #51a351;
  color: #51a351;
}
.box-icon-border.box-icon-success:hover,
[class^="box-icon-border"].box-icon-success:hover,
[class*=" box-icon-border"].box-icon-success:hover,
.box-icon-border.box-icon-to-success:hover:hover,
[class^="box-icon-border"].box-icon-to-success:hover:hover,
[class*=" box-icon-border"].box-icon-to-success:hover:hover {
  background: #51a351;
}
.box-icon-border.box-icon-warning,
[class^="box-icon-border"].box-icon-warning,
[class*=" box-icon-border"].box-icon-warning,
.box-icon-border.box-icon-to-warning:hover,
[class^="box-icon-border"].box-icon-to-warning:hover,
[class*=" box-icon-border"].box-icon-to-warning:hover {
  border-color: #f89406;
  color: #f89406;
}
.box-icon-border.box-icon-warning:hover,
[class^="box-icon-border"].box-icon-warning:hover,
[class*=" box-icon-border"].box-icon-warning:hover,
.box-icon-border.box-icon-to-warning:hover:hover,
[class^="box-icon-border"].box-icon-to-warning:hover:hover,
[class*=" box-icon-border"].box-icon-to-warning:hover:hover {
  background: #f89406;
}
.box-icon-border.box-icon-danger,
[class^="box-icon-border"].box-icon-danger,
[class*=" box-icon-border"].box-icon-danger,
.box-icon-border.box-icon-to-danger:hover,
[class^="box-icon-border"].box-icon-to-danger:hover,
[class*=" box-icon-border"].box-icon-to-danger:hover {
  border-color: #bd362f;
  color: #bd362f;
}
.box-icon-border.box-icon-danger:hover,
[class^="box-icon-border"].box-icon-danger:hover,
[class*=" box-icon-border"].box-icon-danger:hover,
.box-icon-border.box-icon-to-danger:hover:hover,
[class^="box-icon-border"].box-icon-to-danger:hover:hover,
[class*=" box-icon-border"].box-icon-to-danger:hover:hover {
  background: #bd362f;
}
.box-icon-border.box-icon-inverse,
[class^="box-icon-border"].box-icon-inverse,
[class*=" box-icon-border"].box-icon-inverse,
.box-icon-border.box-icon-to-inverse:hover,
[class^="box-icon-border"].box-icon-to-inverse:hover,
[class*=" box-icon-border"].box-icon-to-inverse:hover {
  border-color: #127cdc;
  color: #127cdc;
}
.box-icon-border.box-icon-inverse:hover,
[class^="box-icon-border"].box-icon-inverse:hover,
[class*=" box-icon-border"].box-icon-inverse:hover,
.box-icon-border.box-icon-to-inverse:hover:hover,
[class^="box-icon-border"].box-icon-to-inverse:hover:hover,
[class*=" box-icon-border"].box-icon-to-inverse:hover:hover {
  background: #127cdc;
}
.box-icon-border.box-icon-to-normal:hover,
[class^="box-icon-border"].box-icon-to-normal:hover,
[class*=" box-icon-border"].box-icon-to-normal:hover {
  border-color: <?php echo $themecolor;?>;
  background: <?php echo $themecolor;?>;
}
.box-icon-border-dashed {
  border-style: dashed;
}
.box-icon-left {
  float: left;
  margin-right: 15px;
}
.box-icon-right {
  float: right;
  margin-left: 15px;
}
.box-icon-center {
  margin: 0 auto;
}
.animate-icon,
[class^="animate-icon"],
[class*=" animate-icon"] {
  -webkit-backface-visibility: hidden;
  -moz-backface-visibility: hidden;
  -ms-backface-visibility: hidden;
  backface-visibility: hidden;
}
.animate-icon:before,
[class^="animate-icon"]:before,
[class*=" animate-icon"]:before {
  -webkit-backface-visibility: hidden;
  -moz-backface-visibility: hidden;
  -ms-backface-visibility: hidden;
  backface-visibility: hidden;
}
.animate-icon:hover:before,
[class^="animate-icon"]:hover:before,
[class*=" animate-icon"]:hover:before {
  -webkit-animation-duration: 1s;
  -moz-animation-duration: 1s;
  -o-animation-duration: 1s;
  -ms-animation-duration: 1s;
  animation-duration: 1s;
}
.animate-icon:after,
[class^="animate-icon"]:after,
[class*=" animate-icon"]:after {
  z-index: -1;
  -webkit-backface-visibility: hidden;
  -moz-backface-visibility: hidden;
  -ms-backface-visibility: hidden;
  backface-visibility: hidden;
  position: absolute;
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
  width: 100%;
  height: 100%;
  content: '';
  left: 0;
  top: 0;
}
.animate-icon:hover:after,
[class^="animate-icon"]:hover:after,
[class*=" animate-icon"]:hover:after {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.animate-icon-flash:hover:before {
  -webkit-animation-name: flash;
  -moz-animation-name: flash;
  -o-animation-name: flash;
  -ms-animation-name: flash;
  animation-name: flash;
}
.animate-icon-shake:hover:before {
  -webkit-animation-name: shake;
  -moz-animation-name: shake;
  -o-animation-name: shake;
  -ms-animation-name: shake;
  animation-name: shake;
}
.animate-icon-bounce:hover:before {
  -webkit-animation-name: bounce;
  -moz-animation-name: bounce;
  -o-animation-name: bounce;
  -ms-animation-name: bounce;
  animation-name: bounce;
}
.animate-icon-tada:hover:before {
  -webkit-animation-name: tada;
  -moz-animation-name: tada;
  -o-animation-name: tada;
  -ms-animation-name: tada;
  animation-name: tada;
}
.animate-icon-swing:hover:before {
  -webkit-animation-name: swing;
  -moz-animation-name: swing;
  -o-animation-name: swing;
  -ms-animation-name: swing;
  animation-name: swing;
}
.animate-icon-wobble:hover:before {
  -webkit-animation-name: wobble;
  -moz-animation-name: wobble;
  -o-animation-name: wobble;
  -ms-animation-name: wobble;
  animation-name: wobble;
}
.animate-icon-pulse:hover:before {
  -webkit-animation-name: pulse;
  -moz-animation-name: pulse;
  -o-animation-name: pulse;
  -ms-animation-name: pulse;
  animation-name: pulse;
}
.animate-icon-left-to-right,
.animate-icon-right-to-left,
.animate-icon-bottom-to-top,
.animate-icon-top-to-bottom {
  overflow: hidden;
}
.animate-icon-left-to-right:hover:before {
  -webkit-animation: left-to-right 0.3s forwards;
  -moz-animation: left-to-right 0.3s forwards;
  -o-animation: left-to-right 0.3s forwards;
  -ms-animation: left-to-right 0.3s forwards;
  animation: left-to-right 0.3s forwards;
}
.animate-icon-right-to-left:hover:before {
  -webkit-animation: right-to-left 0.3s forwards;
  -moz-animation: right-to-left 0.3s forwards;
  -o-animation: right-to-left 0.3s forwards;
  -ms-animation: right-to-left 0.3s forwards;
  animation: right-to-left 0.3s forwards;
}
.animate-icon-bottom-to-top:hover:before {
  -webkit-animation: bottom-to-top 0.3s forwards;
  -moz-animation: bottom-to-top 0.3s forwards;
  -o-animation: bottom-to-top 0.3s forwards;
  -ms-animation: bottom-to-top 0.3s forwards;
  animation: bottom-to-top 0.3s forwards;
}
.animate-icon-top-to-bottom:hover:before {
  -webkit-animation: top-to-bottom 0.3s forwards;
  -moz-animation: top-to-bottom 0.3s forwards;
  -o-animation: top-to-bottom 0.3s forwards;
  -ms-animation: top-to-bottom 0.3s forwards;
  animation: top-to-bottom 0.3s forwards;
}
.animate-icon-border-rise:after,
.animate-icon-border-rise-alt:after {
  -webkit-box-shadow: 0 0 0 2px <?php echo $themecolor;?>;
  box-shadow: 0 0 0 2px <?php echo $themecolor;?>;
}
.animate-icon-border-rise.box-icon-black:after,
.animate-icon-border-rise-alt.box-icon-black:after,
.animate-icon-border-rise.box-icon-to-black:hover:after,
.animate-icon-border-rise-alt.box-icon-to-black:hover:after {
  -webkit-box-shadow: 0 0 0 2px #333;
  box-shadow: 0 0 0 2px #333;
}
.animate-icon-border-rise.box-icon-gray:after,
.animate-icon-border-rise-alt.box-icon-gray:after,
.animate-icon-border-rise.box-icon-to-gray:hover:after,
.animate-icon-border-rise-alt.box-icon-to-gray:hover:after {
  -webkit-box-shadow: 0 0 0 2px #808080;
  box-shadow: 0 0 0 2px #808080;
}
.animate-icon-border-rise.box-icon-info:after,
.animate-icon-border-rise-alt.box-icon-info:after,
.animate-icon-border-rise.box-icon-to-info:hover:after,
.animate-icon-border-rise-alt.box-icon-to-info:hover:after {
  -webkit-box-shadow: 0 0 0 2px #2f96b4;
  box-shadow: 0 0 0 2px #2f96b4;
}
.animate-icon-border-rise.box-icon-success:after,
.animate-icon-border-rise-alt.box-icon-success:after,
.animate-icon-border-rise.box-icon-to-success:hover:after,
.animate-icon-border-rise-alt.box-icon-to-success:hover:after {
  -webkit-box-shadow: 0 0 0 2px #51a351;
  box-shadow: 0 0 0 2px #51a351;
}
.animate-icon-border-rise.box-icon-warning:after,
.animate-icon-border-rise-alt.box-icon-warning:after,
.animate-icon-border-rise.box-icon-to-warning:hover:after,
.animate-icon-border-rise-alt.box-icon-to-warning:hover:after {
  -webkit-box-shadow: 0 0 0 2px #f89406;
  box-shadow: 0 0 0 2px #f89406;
}
.animate-icon-border-rise.box-icon-danger:after,
.animate-icon-border-rise-alt.box-icon-danger:after,
.animate-icon-border-rise.box-icon-to-danger:hover:after,
.animate-icon-border-rise-alt.box-icon-to-danger:hover:after {
  -webkit-box-shadow: 0 0 0 2px #bd362f;
  box-shadow: 0 0 0 2px #bd362f;
}
.animate-icon-border-rise.box-icon-inverse:after,
.animate-icon-border-rise-alt.box-icon-inverse:after,
.animate-icon-border-rise.box-icon-to-inverse:hover:after,
.animate-icon-border-rise-alt.box-icon-to-inverse:hover:after {
  -webkit-box-shadow: 0 0 0 2px #127cdc;
  box-shadow: 0 0 0 2px #127cdc;
}
.animate-icon-border-rise.box-icon-to-normal:after:hover,
.animate-icon-border-rise-alt.box-icon-to-normal:after:hover {
  -webkit-box-shadow: 0 0 0 2px <?php echo $themecolor;?>;
  box-shadow: 0 0 0 2px <?php echo $themecolor;?>;
}
.animate-icon-border-rise.round:after,
.animate-icon-border-rise-alt.round:after {
  -webkit-border-radius: 50%;
  border-radius: 50%;
}
.animate-icon-border-rise:after {
  -webkit-transform: scale(0.8);
  -moz-transform: scale(0.8);
  -o-transform: scale(0.8);
  -ms-transform: scale(0.8);
  transform: scale(0.8);
}
.animate-icon-border-rise:hover:after {
  -webkit-transform: scale(1.2);
  -moz-transform: scale(1.2);
  -o-transform: scale(1.2);
  -ms-transform: scale(1.2);
  transform: scale(1.2);
}
.animate-icon-border-rise-alt:after {
  -webkit-transform: scale(1.6);
  -moz-transform: scale(1.6);
  -o-transform: scale(1.6);
  -ms-transform: scale(1.6);
  transform: scale(1.6);
}
.animate-icon-border-rise-alt:hover:after {
  -webkit-transform: scale(1.2);
  -moz-transform: scale(1.2);
  -o-transform: scale(1.2);
  -ms-transform: scale(1.2);
  transform: scale(1.2);
}
.animate-icon-border-fadeout {
  color: #fff;
  background: none;
  border: 2px solid <?php echo $themecolor;?>;
}
.animate-icon-border-fadeout:after {
  opacity: 1;
  -ms-filter: none;
  filter: none;
  background: <?php echo $themecolor;?>;
}
.animate-icon-border-fadeout:hover {
  color: <?php echo $themecolor;?>;
  background: none;
}
.animate-icon-border-fadeout:hover:after {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transform: scale(1.5);
  -moz-transform: scale(1.5);
  -o-transform: scale(1.5);
  -ms-transform: scale(1.5);
  transform: scale(1.5);
}
.animate-icon-border-fadeout.box-icon-black,
.animate-icon-border-fadeout.box-icon-to-black:hover {
  border-color: #333;
}
.animate-icon-border-fadeout.box-icon-black:after,
.animate-icon-border-fadeout.box-icon-to-black:hover:after {
  background: #333;
}
.animate-icon-border-fadeout.box-icon-black:hover,
.animate-icon-border-fadeout.box-icon-to-black:hover:hover {
  color: #333;
}
.animate-icon-border-fadeout.box-icon-gray,
.animate-icon-border-fadeout.box-icon-to-gray:hover {
  border-color: #808080;
}
.animate-icon-border-fadeout.box-icon-gray:after,
.animate-icon-border-fadeout.box-icon-to-gray:hover:after {
  background: #808080;
}
.animate-icon-border-fadeout.box-icon-gray:hover,
.animate-icon-border-fadeout.box-icon-to-gray:hover:hover {
  color: #808080;
}
.animate-icon-border-fadeout.box-icon-info,
.animate-icon-border-fadeout.box-icon-to-info:hover {
  border-color: #2f96b4;
}
.animate-icon-border-fadeout.box-icon-info:after,
.animate-icon-border-fadeout.box-icon-to-info:hover:after {
  background: #2f96b4;
}
.animate-icon-border-fadeout.box-icon-info:hover,
.animate-icon-border-fadeout.box-icon-to-info:hover:hover {
  color: #2f96b4;
}
.animate-icon-border-fadeout.box-icon-success,
.animate-icon-border-fadeout.box-icon-to-success:hover {
  border-color: #51a351;
}
.animate-icon-border-fadeout.box-icon-success:after,
.animate-icon-border-fadeout.box-icon-to-success:hover:after {
  background: #51a351;
}
.animate-icon-border-fadeout.box-icon-success:hover,
.animate-icon-border-fadeout.box-icon-to-success:hover:hover {
  color: #51a351;
}
.animate-icon-border-fadeout.box-icon-warning,
.animate-icon-border-fadeout.box-icon-to-warning:hover {
  border-color: #f89406;
}
.animate-icon-border-fadeout.box-icon-warning:after,
.animate-icon-border-fadeout.box-icon-to-warning:hover:after {
  background: #f89406;
}
.animate-icon-border-fadeout.box-icon-warning:hover,
.animate-icon-border-fadeout.box-icon-to-warning:hover:hover {
  color: #f89406;
}
.animate-icon-border-fadeout.box-icon-danger,
.animate-icon-border-fadeout.box-icon-to-danger:hover {
  border-color: #bd362f;
}
.animate-icon-border-fadeout.box-icon-danger:after,
.animate-icon-border-fadeout.box-icon-to-danger:hover:after {
  background: #bd362f;
}
.animate-icon-border-fadeout.box-icon-danger:hover,
.animate-icon-border-fadeout.box-icon-to-danger:hover:hover {
  color: #bd362f;
}
.animate-icon-border-fadeout.box-icon-inverse,
.animate-icon-border-fadeout.box-icon-to-inverse:hover {
  border-color: #127cdc;
}
.animate-icon-border-fadeout.box-icon-inverse:after,
.animate-icon-border-fadeout.box-icon-to-inverse:hover:after {
  background: #127cdc;
}
.animate-icon-border-fadeout.box-icon-inverse:hover,
.animate-icon-border-fadeout.box-icon-to-inverse:hover:hover {
  color: #127cdc;
}
.animate-icon-border-fadeout.box-icon-to-normal {
  border-color: <?php echo $themecolor;?>;
}
.animate-icon-border-fadeout.box-icon-to-normal:after {
  background: <?php echo $themecolor;?>;
}
.animate-icon-border-fadeout.box-icon-to-normal:hover {
  color: <?php echo $themecolor;?>;
}
.animate-icon-border-fadeout.round:after {
  -webkit-border-radius: 50%;
  border-radius: 50%;
}
.animate-icon-border-fadein {
  color: <?php echo $themecolor;?>;
  background: none;
  border: 2px solid <?php echo $themecolor;?>;
}
.animate-icon-border-fadein:after {
  -webkit-transform: scale(1.5);
  -moz-transform: scale(1.5);
  -o-transform: scale(1.5);
  -ms-transform: scale(1.5);
  transform: scale(1.5);
}
.animate-icon-border-fadein:hover {
  color: #fff !important;
}
.animate-icon-border-fadein:hover:after {
  background: <?php echo $themecolor;?>;
  -webkit-transform: scale(1);
  -moz-transform: scale(1);
  -o-transform: scale(1);
  -ms-transform: scale(1);
  transform: scale(1);
}
.animate-icon-border-fadein.box-icon-black,
.animate-icon-border-fadein.box-icon-to-black:hover {
  color: #333;
  border-color: #333;
}
.animate-icon-border-fadein.box-icon-black:hover:after,
.animate-icon-border-fadein.box-icon-to-black:hover:hover:after {
  background: #333;
}
.animate-icon-border-fadein.box-icon-gray,
.animate-icon-border-fadein.box-icon-to-gray:hover {
  color: #808080;
  border-color: #808080;
}
.animate-icon-border-fadein.box-icon-gray:hover:after,
.animate-icon-border-fadein.box-icon-to-gray:hover:hover:after {
  background: #808080;
}
.animate-icon-border-fadein.box-icon-info,
.animate-icon-border-fadein.box-icon-to-info:hover {
  color: #2f96b4;
  border-color: #2f96b4;
}
.animate-icon-border-fadein.box-icon-info:hover:after,
.animate-icon-border-fadein.box-icon-to-info:hover:hover:after {
  background: #2f96b4;
}
.animate-icon-border-fadein.box-icon-success,
.animate-icon-border-fadein.box-icon-to-success:hover {
  color: #51a351;
  border-color: #51a351;
}
.animate-icon-border-fadein.box-icon-success:hover:after,
.animate-icon-border-fadein.box-icon-to-success:hover:hover:after {
  background: #51a351;
}
.animate-icon-border-fadein.box-icon-warning,
.animate-icon-border-fadein.box-icon-to-warning:hover {
  color: #f89406;
  border-color: #f89406;
}
.animate-icon-border-fadein.box-icon-warning:hover:after,
.animate-icon-border-fadein.box-icon-to-warning:hover:hover:after {
  background: #f89406;
}
.animate-icon-border-fadein.box-icon-danger,
.animate-icon-border-fadein.box-icon-to-danger:hover {
  color: #bd362f;
  border-color: #bd362f;
}
.animate-icon-border-fadein.box-icon-danger:hover:after,
.animate-icon-border-fadein.box-icon-to-danger:hover:hover:after {
  background: #bd362f;
}
.animate-icon-border-fadein.box-icon-inverse,
.animate-icon-border-fadein.box-icon-to-inverse:hover {
  color: #127cdc;
  border-color: #127cdc;
}
.animate-icon-border-fadein.box-icon-inverse:hover:after,
.animate-icon-border-fadein.box-icon-to-inverse:hover:hover:after {
  background: #127cdc;
}
.animate-icon-border-fadein.box-icon-to-normal:hover {
  color: <?php echo $themecolor;?>;
  border-color: <?php echo $themecolor;?>;
}
.animate-icon-border-fadein.box-icon-to-normal:hover:hover:after {
  background: <?php echo $themecolor;?>;
}
.animate-icon-border-fadein.round:after {
  -webkit-border-radius: 50%;
  border-radius: 50%;
}
@-moz-keyframes flash {
  0%, 50%, 100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }

  25%, 75% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }
}
@-webkit-keyframes flash {
  0%, 50%, 100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }

  25%, 75% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }
}
@-o-keyframes flash {
  0%, 50%, 100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }

  25%, 75% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }
}
@-ms-keyframes flash {
  0%, 50%, 100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }

  25%, 75% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }
}
@keyframes flash {
  0%, 50%, 100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }

  25%, 75% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }
}
@-moz-keyframes shake {
  0%, 100% {
    -webkit-transform: translateX(0);
    -moz-transform: translateX(0);
    -o-transform: translateX(0);
    -ms-transform: translateX(0);
    transform: translateX(0);
  }

  10%, 30%, 50%, 70%, 90% {
    -webkit-transform: translateX(-10%);
    -moz-transform: translateX(-10%);
    -o-transform: translateX(-10%);
    -ms-transform: translateX(-10%);
    transform: translateX(-10%);
  }

  20%, 40%, 60%, 80% {
    -webkit-transform: translateX(10%);
    -moz-transform: translateX(10%);
    -o-transform: translateX(10%);
    -ms-transform: translateX(10%);
    transform: translateX(10%);
  }
}
@-webkit-keyframes shake {
  0%, 100% {
    -webkit-transform: translateX(0);
    -moz-transform: translateX(0);
    -o-transform: translateX(0);
    -ms-transform: translateX(0);
    transform: translateX(0);
  }

  10%, 30%, 50%, 70%, 90% {
    -webkit-transform: translateX(-10%);
    -moz-transform: translateX(-10%);
    -o-transform: translateX(-10%);
    -ms-transform: translateX(-10%);
    transform: translateX(-10%);
  }

  20%, 40%, 60%, 80% {
    -webkit-transform: translateX(10%);
    -moz-transform: translateX(10%);
    -o-transform: translateX(10%);
    -ms-transform: translateX(10%);
    transform: translateX(10%);
  }
}
@-o-keyframes shake {
  0%, 100% {
    -webkit-transform: translateX(0);
    -moz-transform: translateX(0);
    -o-transform: translateX(0);
    -ms-transform: translateX(0);
    transform: translateX(0);
  }

  10%, 30%, 50%, 70%, 90% {
    -webkit-transform: translateX(-10%);
    -moz-transform: translateX(-10%);
    -o-transform: translateX(-10%);
    -ms-transform: translateX(-10%);
    transform: translateX(-10%);
  }

  20%, 40%, 60%, 80% {
    -webkit-transform: translateX(10%);
    -moz-transform: translateX(10%);
    -o-transform: translateX(10%);
    -ms-transform: translateX(10%);
    transform: translateX(10%);
  }
}
@-ms-keyframes shake {
  0%, 100% {
    -webkit-transform: translateX(0);
    -moz-transform: translateX(0);
    -o-transform: translateX(0);
    -ms-transform: translateX(0);
    transform: translateX(0);
  }

  10%, 30%, 50%, 70%, 90% {
    -webkit-transform: translateX(-10%);
    -moz-transform: translateX(-10%);
    -o-transform: translateX(-10%);
    -ms-transform: translateX(-10%);
    transform: translateX(-10%);
  }

  20%, 40%, 60%, 80% {
    -webkit-transform: translateX(10%);
    -moz-transform: translateX(10%);
    -o-transform: translateX(10%);
    -ms-transform: translateX(10%);
    transform: translateX(10%);
  }
}
@keyframes shake {
  0%, 100% {
    -webkit-transform: translateX(0);
    -moz-transform: translateX(0);
    -o-transform: translateX(0);
    -ms-transform: translateX(0);
    transform: translateX(0);
  }

  10%, 30%, 50%, 70%, 90% {
    -webkit-transform: translateX(-10%);
    -moz-transform: translateX(-10%);
    -o-transform: translateX(-10%);
    -ms-transform: translateX(-10%);
    transform: translateX(-10%);
  }

  20%, 40%, 60%, 80% {
    -webkit-transform: translateX(10%);
    -moz-transform: translateX(10%);
    -o-transform: translateX(10%);
    -ms-transform: translateX(10%);
    transform: translateX(10%);
  }
}
@-moz-keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    -webkit-transform: translateY(0);
    -moz-transform: translateY(0);
    -o-transform: translateY(0);
    -ms-transform: translateY(0);
    transform: translateY(0);
  }

  40% {
    -webkit-transform: translateY(-30%);
    -moz-transform: translateY(-30%);
    -o-transform: translateY(-30%);
    -ms-transform: translateY(-30%);
    transform: translateY(-30%);
  }

  60% {
    -webkit-transform: translateY(-15%);
    -moz-transform: translateY(-15%);
    -o-transform: translateY(-15%);
    -ms-transform: translateY(-15%);
    transform: translateY(-15%);
  }
}
@-webkit-keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    -webkit-transform: translateY(0);
    -moz-transform: translateY(0);
    -o-transform: translateY(0);
    -ms-transform: translateY(0);
    transform: translateY(0);
  }

  40% {
    -webkit-transform: translateY(-30%);
    -moz-transform: translateY(-30%);
    -o-transform: translateY(-30%);
    -ms-transform: translateY(-30%);
    transform: translateY(-30%);
  }

  60% {
    -webkit-transform: translateY(-15%);
    -moz-transform: translateY(-15%);
    -o-transform: translateY(-15%);
    -ms-transform: translateY(-15%);
    transform: translateY(-15%);
  }
}
@-o-keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    -webkit-transform: translateY(0);
    -moz-transform: translateY(0);
    -o-transform: translateY(0);
    -ms-transform: translateY(0);
    transform: translateY(0);
  }

  40% {
    -webkit-transform: translateY(-30%);
    -moz-transform: translateY(-30%);
    -o-transform: translateY(-30%);
    -ms-transform: translateY(-30%);
    transform: translateY(-30%);
  }

  60% {
    -webkit-transform: translateY(-15%);
    -moz-transform: translateY(-15%);
    -o-transform: translateY(-15%);
    -ms-transform: translateY(-15%);
    transform: translateY(-15%);
  }
}
@-ms-keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    -webkit-transform: translateY(0);
    -moz-transform: translateY(0);
    -o-transform: translateY(0);
    -ms-transform: translateY(0);
    transform: translateY(0);
  }

  40% {
    -webkit-transform: translateY(-30%);
    -moz-transform: translateY(-30%);
    -o-transform: translateY(-30%);
    -ms-transform: translateY(-30%);
    transform: translateY(-30%);
  }

  60% {
    -webkit-transform: translateY(-15%);
    -moz-transform: translateY(-15%);
    -o-transform: translateY(-15%);
    -ms-transform: translateY(-15%);
    transform: translateY(-15%);
  }
}
@keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    -webkit-transform: translateY(0);
    -moz-transform: translateY(0);
    -o-transform: translateY(0);
    -ms-transform: translateY(0);
    transform: translateY(0);
  }

  40% {
    -webkit-transform: translateY(-30%);
    -moz-transform: translateY(-30%);
    -o-transform: translateY(-30%);
    -ms-transform: translateY(-30%);
    transform: translateY(-30%);
  }

  60% {
    -webkit-transform: translateY(-15%);
    -moz-transform: translateY(-15%);
    -o-transform: translateY(-15%);
    -ms-transform: translateY(-15%);
    transform: translateY(-15%);
  }
}
@-moz-keyframes tada {
  0% {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -o-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
  }

  10%, 20% {
    -webkit-transform: scale(0.9) rotate(-3deg);
    -moz-transform: scale(0.9) rotate(-3deg);
    -o-transform: scale(0.9) rotate(-3deg);
    -ms-transform: scale(0.9) rotate(-3deg);
    transform: scale(0.9) rotate(-3deg);
  }

  30%, 50%, 70%, 90% {
    -webkit-transform: scale(1.1) rotate(3deg);
    -moz-transform: scale(1.1) rotate(3deg);
    -o-transform: scale(1.1) rotate(3deg);
    -ms-transform: scale(1.1) rotate(3deg);
    transform: scale(1.1) rotate(3deg);
  }

  40%, 60%, 80% {
    -webkit-transform: scale(1.1) rotate(-3deg);
    -moz-transform: scale(1.1) rotate(-3deg);
    -o-transform: scale(1.1) rotate(-3deg);
    -ms-transform: scale(1.1) rotate(-3deg);
    transform: scale(1.1) rotate(-3deg);
  }

  100% {
    -webkit-transform: scale(1) rotate(0);
    -moz-transform: scale(1) rotate(0);
    -o-transform: scale(1) rotate(0);
    -ms-transform: scale(1) rotate(0);
    transform: scale(1) rotate(0);
  }
}
@-webkit-keyframes tada {
  0% {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -o-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
  }

  10%, 20% {
    -webkit-transform: scale(0.9) rotate(-3deg);
    -moz-transform: scale(0.9) rotate(-3deg);
    -o-transform: scale(0.9) rotate(-3deg);
    -ms-transform: scale(0.9) rotate(-3deg);
    transform: scale(0.9) rotate(-3deg);
  }

  30%, 50%, 70%, 90% {
    -webkit-transform: scale(1.1) rotate(3deg);
    -moz-transform: scale(1.1) rotate(3deg);
    -o-transform: scale(1.1) rotate(3deg);
    -ms-transform: scale(1.1) rotate(3deg);
    transform: scale(1.1) rotate(3deg);
  }

  40%, 60%, 80% {
    -webkit-transform: scale(1.1) rotate(-3deg);
    -moz-transform: scale(1.1) rotate(-3deg);
    -o-transform: scale(1.1) rotate(-3deg);
    -ms-transform: scale(1.1) rotate(-3deg);
    transform: scale(1.1) rotate(-3deg);
  }

  100% {
    -webkit-transform: scale(1) rotate(0);
    -moz-transform: scale(1) rotate(0);
    -o-transform: scale(1) rotate(0);
    -ms-transform: scale(1) rotate(0);
    transform: scale(1) rotate(0);
  }
}
@-o-keyframes tada {
  0% {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -o-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
  }

  10%, 20% {
    -webkit-transform: scale(0.9) rotate(-3deg);
    -moz-transform: scale(0.9) rotate(-3deg);
    -o-transform: scale(0.9) rotate(-3deg);
    -ms-transform: scale(0.9) rotate(-3deg);
    transform: scale(0.9) rotate(-3deg);
  }

  30%, 50%, 70%, 90% {
    -webkit-transform: scale(1.1) rotate(3deg);
    -moz-transform: scale(1.1) rotate(3deg);
    -o-transform: scale(1.1) rotate(3deg);
    -ms-transform: scale(1.1) rotate(3deg);
    transform: scale(1.1) rotate(3deg);
  }

  40%, 60%, 80% {
    -webkit-transform: scale(1.1) rotate(-3deg);
    -moz-transform: scale(1.1) rotate(-3deg);
    -o-transform: scale(1.1) rotate(-3deg);
    -ms-transform: scale(1.1) rotate(-3deg);
    transform: scale(1.1) rotate(-3deg);
  }

  100% {
    -webkit-transform: scale(1) rotate(0);
    -moz-transform: scale(1) rotate(0);
    -o-transform: scale(1) rotate(0);
    -ms-transform: scale(1) rotate(0);
    transform: scale(1) rotate(0);
  }
}
@-ms-keyframes tada {
  0% {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -o-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
  }

  10%, 20% {
    -webkit-transform: scale(0.9) rotate(-3deg);
    -moz-transform: scale(0.9) rotate(-3deg);
    -o-transform: scale(0.9) rotate(-3deg);
    -ms-transform: scale(0.9) rotate(-3deg);
    transform: scale(0.9) rotate(-3deg);
  }

  30%, 50%, 70%, 90% {
    -webkit-transform: scale(1.1) rotate(3deg);
    -moz-transform: scale(1.1) rotate(3deg);
    -o-transform: scale(1.1) rotate(3deg);
    -ms-transform: scale(1.1) rotate(3deg);
    transform: scale(1.1) rotate(3deg);
  }

  40%, 60%, 80% {
    -webkit-transform: scale(1.1) rotate(-3deg);
    -moz-transform: scale(1.1) rotate(-3deg);
    -o-transform: scale(1.1) rotate(-3deg);
    -ms-transform: scale(1.1) rotate(-3deg);
    transform: scale(1.1) rotate(-3deg);
  }

  100% {
    -webkit-transform: scale(1) rotate(0);
    -moz-transform: scale(1) rotate(0);
    -o-transform: scale(1) rotate(0);
    -ms-transform: scale(1) rotate(0);
    transform: scale(1) rotate(0);
  }
}
@keyframes tada {
  0% {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -o-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
  }

  10%, 20% {
    -webkit-transform: scale(0.9) rotate(-3deg);
    -moz-transform: scale(0.9) rotate(-3deg);
    -o-transform: scale(0.9) rotate(-3deg);
    -ms-transform: scale(0.9) rotate(-3deg);
    transform: scale(0.9) rotate(-3deg);
  }

  30%, 50%, 70%, 90% {
    -webkit-transform: scale(1.1) rotate(3deg);
    -moz-transform: scale(1.1) rotate(3deg);
    -o-transform: scale(1.1) rotate(3deg);
    -ms-transform: scale(1.1) rotate(3deg);
    transform: scale(1.1) rotate(3deg);
  }

  40%, 60%, 80% {
    -webkit-transform: scale(1.1) rotate(-3deg);
    -moz-transform: scale(1.1) rotate(-3deg);
    -o-transform: scale(1.1) rotate(-3deg);
    -ms-transform: scale(1.1) rotate(-3deg);
    transform: scale(1.1) rotate(-3deg);
  }

  100% {
    -webkit-transform: scale(1) rotate(0);
    -moz-transform: scale(1) rotate(0);
    -o-transform: scale(1) rotate(0);
    -ms-transform: scale(1) rotate(0);
    transform: scale(1) rotate(0);
  }
}
@-moz-keyframes swing {
  20%, 40%, 60%, 80%, 100% {
    -webkit-transform-origin: top center;
    -moz-transform-origin: top center;
    -o-transform-origin: top center;
    -ms-transform-origin: top center;
    transform-origin: top center;
  }

  20% {
    -webkit-transform: rotate(15deg);
    -moz-transform: rotate(15deg);
    -o-transform: rotate(15deg);
    -ms-transform: rotate(15deg);
    transform: rotate(15deg);
  }

  40% {
    -webkit-transform: rotate(-10deg);
    -moz-transform: rotate(-10deg);
    -o-transform: rotate(-10deg);
    -ms-transform: rotate(-10deg);
    transform: rotate(-10deg);
  }

  60% {
    -webkit-transform: rotate(5deg);
    -moz-transform: rotate(5deg);
    -o-transform: rotate(5deg);
    -ms-transform: rotate(5deg);
    transform: rotate(5deg);
  }

  80% {
    -webkit-transform: rotate(-5deg);
    -moz-transform: rotate(-5deg);
    -o-transform: rotate(-5deg);
    -ms-transform: rotate(-5deg);
    transform: rotate(-5deg);
  }

  100% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    transform: rotate(0deg);
  }
}
@-webkit-keyframes swing {
  20%, 40%, 60%, 80%, 100% {
    -webkit-transform-origin: top center;
    -moz-transform-origin: top center;
    -o-transform-origin: top center;
    -ms-transform-origin: top center;
    transform-origin: top center;
  }

  20% {
    -webkit-transform: rotate(15deg);
    -moz-transform: rotate(15deg);
    -o-transform: rotate(15deg);
    -ms-transform: rotate(15deg);
    transform: rotate(15deg);
  }

  40% {
    -webkit-transform: rotate(-10deg);
    -moz-transform: rotate(-10deg);
    -o-transform: rotate(-10deg);
    -ms-transform: rotate(-10deg);
    transform: rotate(-10deg);
  }

  60% {
    -webkit-transform: rotate(5deg);
    -moz-transform: rotate(5deg);
    -o-transform: rotate(5deg);
    -ms-transform: rotate(5deg);
    transform: rotate(5deg);
  }

  80% {
    -webkit-transform: rotate(-5deg);
    -moz-transform: rotate(-5deg);
    -o-transform: rotate(-5deg);
    -ms-transform: rotate(-5deg);
    transform: rotate(-5deg);
  }

  100% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    transform: rotate(0deg);
  }
}
@-o-keyframes swing {
  20%, 40%, 60%, 80%, 100% {
    -webkit-transform-origin: top center;
    -moz-transform-origin: top center;
    -o-transform-origin: top center;
    -ms-transform-origin: top center;
    transform-origin: top center;
  }

  20% {
    -webkit-transform: rotate(15deg);
    -moz-transform: rotate(15deg);
    -o-transform: rotate(15deg);
    -ms-transform: rotate(15deg);
    transform: rotate(15deg);
  }

  40% {
    -webkit-transform: rotate(-10deg);
    -moz-transform: rotate(-10deg);
    -o-transform: rotate(-10deg);
    -ms-transform: rotate(-10deg);
    transform: rotate(-10deg);
  }

  60% {
    -webkit-transform: rotate(5deg);
    -moz-transform: rotate(5deg);
    -o-transform: rotate(5deg);
    -ms-transform: rotate(5deg);
    transform: rotate(5deg);
  }

  80% {
    -webkit-transform: rotate(-5deg);
    -moz-transform: rotate(-5deg);
    -o-transform: rotate(-5deg);
    -ms-transform: rotate(-5deg);
    transform: rotate(-5deg);
  }

  100% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    transform: rotate(0deg);
  }
}
@-ms-keyframes swing {
  20%, 40%, 60%, 80%, 100% {
    -webkit-transform-origin: top center;
    -moz-transform-origin: top center;
    -o-transform-origin: top center;
    -ms-transform-origin: top center;
    transform-origin: top center;
  }

  20% {
    -webkit-transform: rotate(15deg);
    -moz-transform: rotate(15deg);
    -o-transform: rotate(15deg);
    -ms-transform: rotate(15deg);
    transform: rotate(15deg);
  }

  40% {
    -webkit-transform: rotate(-10deg);
    -moz-transform: rotate(-10deg);
    -o-transform: rotate(-10deg);
    -ms-transform: rotate(-10deg);
    transform: rotate(-10deg);
  }

  60% {
    -webkit-transform: rotate(5deg);
    -moz-transform: rotate(5deg);
    -o-transform: rotate(5deg);
    -ms-transform: rotate(5deg);
    transform: rotate(5deg);
  }

  80% {
    -webkit-transform: rotate(-5deg);
    -moz-transform: rotate(-5deg);
    -o-transform: rotate(-5deg);
    -ms-transform: rotate(-5deg);
    transform: rotate(-5deg);
  }

  100% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    transform: rotate(0deg);
  }
}
@keyframes swing {
  20%, 40%, 60%, 80%, 100% {
    -webkit-transform-origin: top center;
    -moz-transform-origin: top center;
    -o-transform-origin: top center;
    -ms-transform-origin: top center;
    transform-origin: top center;
  }

  20% {
    -webkit-transform: rotate(15deg);
    -moz-transform: rotate(15deg);
    -o-transform: rotate(15deg);
    -ms-transform: rotate(15deg);
    transform: rotate(15deg);
  }

  40% {
    -webkit-transform: rotate(-10deg);
    -moz-transform: rotate(-10deg);
    -o-transform: rotate(-10deg);
    -ms-transform: rotate(-10deg);
    transform: rotate(-10deg);
  }

  60% {
    -webkit-transform: rotate(5deg);
    -moz-transform: rotate(5deg);
    -o-transform: rotate(5deg);
    -ms-transform: rotate(5deg);
    transform: rotate(5deg);
  }

  80% {
    -webkit-transform: rotate(-5deg);
    -moz-transform: rotate(-5deg);
    -o-transform: rotate(-5deg);
    -ms-transform: rotate(-5deg);
    transform: rotate(-5deg);
  }

  100% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    transform: rotate(0deg);
  }
}
@-moz-keyframes wobble {
  0% {
    -webkit-transform: translateX(0%);
    -moz-transform: translateX(0%);
    -o-transform: translateX(0%);
    -ms-transform: translateX(0%);
    transform: translateX(0%);
  }

  15% {
    -webkit-transform: translateX(-25%) rotate(-5deg);
    -moz-transform: translateX(-25%) rotate(-5deg);
    -o-transform: translateX(-25%) rotate(-5deg);
    -ms-transform: translateX(-25%) rotate(-5deg);
    transform: translateX(-25%) rotate(-5deg);
  }

  30% {
    -webkit-transform: translateX(20%) rotate(3deg);
    -moz-transform: translateX(20%) rotate(3deg);
    -o-transform: translateX(20%) rotate(3deg);
    -ms-transform: translateX(20%) rotate(3deg);
    transform: translateX(20%) rotate(3deg);
  }

  45% {
    -webkit-transform: translateX(-15%) rotate(-3deg);
    -moz-transform: translateX(-15%) rotate(-3deg);
    -o-transform: translateX(-15%) rotate(-3deg);
    -ms-transform: translateX(-15%) rotate(-3deg);
    transform: translateX(-15%) rotate(-3deg);
  }

  60% {
    -webkit-transform: translateX(10%) rotate(2deg);
    -moz-transform: translateX(10%) rotate(2deg);
    -o-transform: translateX(10%) rotate(2deg);
    -ms-transform: translateX(10%) rotate(2deg);
    transform: translateX(10%) rotate(2deg);
  }

  75% {
    -webkit-transform: translateX(-5%) rotate(-1deg);
    -moz-transform: translateX(-5%) rotate(-1deg);
    -o-transform: translateX(-5%) rotate(-1deg);
    -ms-transform: translateX(-5%) rotate(-1deg);
    transform: translateX(-5%) rotate(-1deg);
  }

  100% {
    -webkit-transform: translateX(0%);
    -moz-transform: translateX(0%);
    -o-transform: translateX(0%);
    -ms-transform: translateX(0%);
    transform: translateX(0%);
  }
}
@-webkit-keyframes wobble {
  0% {
    -webkit-transform: translateX(0%);
    -moz-transform: translateX(0%);
    -o-transform: translateX(0%);
    -ms-transform: translateX(0%);
    transform: translateX(0%);
  }

  15% {
    -webkit-transform: translateX(-25%) rotate(-5deg);
    -moz-transform: translateX(-25%) rotate(-5deg);
    -o-transform: translateX(-25%) rotate(-5deg);
    -ms-transform: translateX(-25%) rotate(-5deg);
    transform: translateX(-25%) rotate(-5deg);
  }

  30% {
    -webkit-transform: translateX(20%) rotate(3deg);
    -moz-transform: translateX(20%) rotate(3deg);
    -o-transform: translateX(20%) rotate(3deg);
    -ms-transform: translateX(20%) rotate(3deg);
    transform: translateX(20%) rotate(3deg);
  }

  45% {
    -webkit-transform: translateX(-15%) rotate(-3deg);
    -moz-transform: translateX(-15%) rotate(-3deg);
    -o-transform: translateX(-15%) rotate(-3deg);
    -ms-transform: translateX(-15%) rotate(-3deg);
    transform: translateX(-15%) rotate(-3deg);
  }

  60% {
    -webkit-transform: translateX(10%) rotate(2deg);
    -moz-transform: translateX(10%) rotate(2deg);
    -o-transform: translateX(10%) rotate(2deg);
    -ms-transform: translateX(10%) rotate(2deg);
    transform: translateX(10%) rotate(2deg);
  }

  75% {
    -webkit-transform: translateX(-5%) rotate(-1deg);
    -moz-transform: translateX(-5%) rotate(-1deg);
    -o-transform: translateX(-5%) rotate(-1deg);
    -ms-transform: translateX(-5%) rotate(-1deg);
    transform: translateX(-5%) rotate(-1deg);
  }

  100% {
    -webkit-transform: translateX(0%);
    -moz-transform: translateX(0%);
    -o-transform: translateX(0%);
    -ms-transform: translateX(0%);
    transform: translateX(0%);
  }
}
@-o-keyframes wobble {
  0% {
    -webkit-transform: translateX(0%);
    -moz-transform: translateX(0%);
    -o-transform: translateX(0%);
    -ms-transform: translateX(0%);
    transform: translateX(0%);
  }

  15% {
    -webkit-transform: translateX(-25%) rotate(-5deg);
    -moz-transform: translateX(-25%) rotate(-5deg);
    -o-transform: translateX(-25%) rotate(-5deg);
    -ms-transform: translateX(-25%) rotate(-5deg);
    transform: translateX(-25%) rotate(-5deg);
  }

  30% {
    -webkit-transform: translateX(20%) rotate(3deg);
    -moz-transform: translateX(20%) rotate(3deg);
    -o-transform: translateX(20%) rotate(3deg);
    -ms-transform: translateX(20%) rotate(3deg);
    transform: translateX(20%) rotate(3deg);
  }

  45% {
    -webkit-transform: translateX(-15%) rotate(-3deg);
    -moz-transform: translateX(-15%) rotate(-3deg);
    -o-transform: translateX(-15%) rotate(-3deg);
    -ms-transform: translateX(-15%) rotate(-3deg);
    transform: translateX(-15%) rotate(-3deg);
  }

  60% {
    -webkit-transform: translateX(10%) rotate(2deg);
    -moz-transform: translateX(10%) rotate(2deg);
    -o-transform: translateX(10%) rotate(2deg);
    -ms-transform: translateX(10%) rotate(2deg);
    transform: translateX(10%) rotate(2deg);
  }

  75% {
    -webkit-transform: translateX(-5%) rotate(-1deg);
    -moz-transform: translateX(-5%) rotate(-1deg);
    -o-transform: translateX(-5%) rotate(-1deg);
    -ms-transform: translateX(-5%) rotate(-1deg);
    transform: translateX(-5%) rotate(-1deg);
  }

  100% {
    -webkit-transform: translateX(0%);
    -moz-transform: translateX(0%);
    -o-transform: translateX(0%);
    -ms-transform: translateX(0%);
    transform: translateX(0%);
  }
}
@-ms-keyframes wobble {
  0% {
    -webkit-transform: translateX(0%);
    -moz-transform: translateX(0%);
    -o-transform: translateX(0%);
    -ms-transform: translateX(0%);
    transform: translateX(0%);
  }

  15% {
    -webkit-transform: translateX(-25%) rotate(-5deg);
    -moz-transform: translateX(-25%) rotate(-5deg);
    -o-transform: translateX(-25%) rotate(-5deg);
    -ms-transform: translateX(-25%) rotate(-5deg);
    transform: translateX(-25%) rotate(-5deg);
  }

  30% {
    -webkit-transform: translateX(20%) rotate(3deg);
    -moz-transform: translateX(20%) rotate(3deg);
    -o-transform: translateX(20%) rotate(3deg);
    -ms-transform: translateX(20%) rotate(3deg);
    transform: translateX(20%) rotate(3deg);
  }

  45% {
    -webkit-transform: translateX(-15%) rotate(-3deg);
    -moz-transform: translateX(-15%) rotate(-3deg);
    -o-transform: translateX(-15%) rotate(-3deg);
    -ms-transform: translateX(-15%) rotate(-3deg);
    transform: translateX(-15%) rotate(-3deg);
  }

  60% {
    -webkit-transform: translateX(10%) rotate(2deg);
    -moz-transform: translateX(10%) rotate(2deg);
    -o-transform: translateX(10%) rotate(2deg);
    -ms-transform: translateX(10%) rotate(2deg);
    transform: translateX(10%) rotate(2deg);
  }

  75% {
    -webkit-transform: translateX(-5%) rotate(-1deg);
    -moz-transform: translateX(-5%) rotate(-1deg);
    -o-transform: translateX(-5%) rotate(-1deg);
    -ms-transform: translateX(-5%) rotate(-1deg);
    transform: translateX(-5%) rotate(-1deg);
  }

  100% {
    -webkit-transform: translateX(0%);
    -moz-transform: translateX(0%);
    -o-transform: translateX(0%);
    -ms-transform: translateX(0%);
    transform: translateX(0%);
  }
}
@keyframes wobble {
  0% {
    -webkit-transform: translateX(0%);
    -moz-transform: translateX(0%);
    -o-transform: translateX(0%);
    -ms-transform: translateX(0%);
    transform: translateX(0%);
  }

  15% {
    -webkit-transform: translateX(-25%) rotate(-5deg);
    -moz-transform: translateX(-25%) rotate(-5deg);
    -o-transform: translateX(-25%) rotate(-5deg);
    -ms-transform: translateX(-25%) rotate(-5deg);
    transform: translateX(-25%) rotate(-5deg);
  }

  30% {
    -webkit-transform: translateX(20%) rotate(3deg);
    -moz-transform: translateX(20%) rotate(3deg);
    -o-transform: translateX(20%) rotate(3deg);
    -ms-transform: translateX(20%) rotate(3deg);
    transform: translateX(20%) rotate(3deg);
  }

  45% {
    -webkit-transform: translateX(-15%) rotate(-3deg);
    -moz-transform: translateX(-15%) rotate(-3deg);
    -o-transform: translateX(-15%) rotate(-3deg);
    -ms-transform: translateX(-15%) rotate(-3deg);
    transform: translateX(-15%) rotate(-3deg);
  }

  60% {
    -webkit-transform: translateX(10%) rotate(2deg);
    -moz-transform: translateX(10%) rotate(2deg);
    -o-transform: translateX(10%) rotate(2deg);
    -ms-transform: translateX(10%) rotate(2deg);
    transform: translateX(10%) rotate(2deg);
  }

  75% {
    -webkit-transform: translateX(-5%) rotate(-1deg);
    -moz-transform: translateX(-5%) rotate(-1deg);
    -o-transform: translateX(-5%) rotate(-1deg);
    -ms-transform: translateX(-5%) rotate(-1deg);
    transform: translateX(-5%) rotate(-1deg);
  }

  100% {
    -webkit-transform: translateX(0%);
    -moz-transform: translateX(0%);
    -o-transform: translateX(0%);
    -ms-transform: translateX(0%);
    transform: translateX(0%);
  }
}
@-moz-keyframes pulse {
  0% {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -o-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
  }

  50% {
    -webkit-transform: scale(1.3);
    -moz-transform: scale(1.3);
    -o-transform: scale(1.3);
    -ms-transform: scale(1.3);
    transform: scale(1.3);
  }

  100% {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -o-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
  }
}
@-webkit-keyframes pulse {
  0% {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -o-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
  }

  50% {
    -webkit-transform: scale(1.3);
    -moz-transform: scale(1.3);
    -o-transform: scale(1.3);
    -ms-transform: scale(1.3);
    transform: scale(1.3);
  }

  100% {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -o-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
  }
}
@-o-keyframes pulse {
  0% {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -o-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
  }

  50% {
    -webkit-transform: scale(1.3);
    -moz-transform: scale(1.3);
    -o-transform: scale(1.3);
    -ms-transform: scale(1.3);
    transform: scale(1.3);
  }

  100% {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -o-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
  }
}
@-ms-keyframes pulse {
  0% {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -o-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
  }

  50% {
    -webkit-transform: scale(1.3);
    -moz-transform: scale(1.3);
    -o-transform: scale(1.3);
    -ms-transform: scale(1.3);
    transform: scale(1.3);
  }

  100% {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -o-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
  }
}
@keyframes pulse {
  0% {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -o-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
  }

  50% {
    -webkit-transform: scale(1.3);
    -moz-transform: scale(1.3);
    -o-transform: scale(1.3);
    -ms-transform: scale(1.3);
    transform: scale(1.3);
  }

  100% {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -o-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
  }
}
@-moz-keyframes left-to-right {
  49% {
    -webkit-transform: translate(100%);
    -moz-transform: translate(100%);
    -o-transform: translate(100%);
    -ms-transform: translate(100%);
    transform: translate(100%);
  }

  50% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: translate(-100%);
    -moz-transform: translate(-100%);
    -o-transform: translate(-100%);
    -ms-transform: translate(-100%);
    transform: translate(-100%);
  }

  51% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-webkit-keyframes left-to-right {
  49% {
    -webkit-transform: translate(100%);
    -moz-transform: translate(100%);
    -o-transform: translate(100%);
    -ms-transform: translate(100%);
    transform: translate(100%);
  }

  50% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: translate(-100%);
    -moz-transform: translate(-100%);
    -o-transform: translate(-100%);
    -ms-transform: translate(-100%);
    transform: translate(-100%);
  }

  51% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-o-keyframes left-to-right {
  49% {
    -webkit-transform: translate(100%);
    -moz-transform: translate(100%);
    -o-transform: translate(100%);
    -ms-transform: translate(100%);
    transform: translate(100%);
  }

  50% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: translate(-100%);
    -moz-transform: translate(-100%);
    -o-transform: translate(-100%);
    -ms-transform: translate(-100%);
    transform: translate(-100%);
  }

  51% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-ms-keyframes left-to-right {
  49% {
    -webkit-transform: translate(100%);
    -moz-transform: translate(100%);
    -o-transform: translate(100%);
    -ms-transform: translate(100%);
    transform: translate(100%);
  }

  50% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: translate(-100%);
    -moz-transform: translate(-100%);
    -o-transform: translate(-100%);
    -ms-transform: translate(-100%);
    transform: translate(-100%);
  }

  51% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@keyframes left-to-right {
  49% {
    -webkit-transform: translate(100%);
    -moz-transform: translate(100%);
    -o-transform: translate(100%);
    -ms-transform: translate(100%);
    transform: translate(100%);
  }

  50% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: translate(-100%);
    -moz-transform: translate(-100%);
    -o-transform: translate(-100%);
    -ms-transform: translate(-100%);
    transform: translate(-100%);
  }

  51% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-moz-keyframes right-to-left {
  49% {
    -webkit-transform: translate(-100%);
    -moz-transform: translate(-100%);
    -o-transform: translate(-100%);
    -ms-transform: translate(-100%);
    transform: translate(-100%);
  }

  50% {
    -webkit-transform: translate(100%);
    -moz-transform: translate(100%);
    -o-transform: translate(100%);
    -ms-transform: translate(100%);
    transform: translate(100%);
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }

  51% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-webkit-keyframes right-to-left {
  49% {
    -webkit-transform: translate(-100%);
    -moz-transform: translate(-100%);
    -o-transform: translate(-100%);
    -ms-transform: translate(-100%);
    transform: translate(-100%);
  }

  50% {
    -webkit-transform: translate(100%);
    -moz-transform: translate(100%);
    -o-transform: translate(100%);
    -ms-transform: translate(100%);
    transform: translate(100%);
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }

  51% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-o-keyframes right-to-left {
  49% {
    -webkit-transform: translate(-100%);
    -moz-transform: translate(-100%);
    -o-transform: translate(-100%);
    -ms-transform: translate(-100%);
    transform: translate(-100%);
  }

  50% {
    -webkit-transform: translate(100%);
    -moz-transform: translate(100%);
    -o-transform: translate(100%);
    -ms-transform: translate(100%);
    transform: translate(100%);
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }

  51% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-ms-keyframes right-to-left {
  49% {
    -webkit-transform: translate(-100%);
    -moz-transform: translate(-100%);
    -o-transform: translate(-100%);
    -ms-transform: translate(-100%);
    transform: translate(-100%);
  }

  50% {
    -webkit-transform: translate(100%);
    -moz-transform: translate(100%);
    -o-transform: translate(100%);
    -ms-transform: translate(100%);
    transform: translate(100%);
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }

  51% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@keyframes right-to-left {
  49% {
    -webkit-transform: translate(-100%);
    -moz-transform: translate(-100%);
    -o-transform: translate(-100%);
    -ms-transform: translate(-100%);
    transform: translate(-100%);
  }

  50% {
    -webkit-transform: translate(100%);
    -moz-transform: translate(100%);
    -o-transform: translate(100%);
    -ms-transform: translate(100%);
    transform: translate(100%);
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }

  51% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-moz-keyframes bottom-to-top {
  49% {
    -webkit-transform: translateY(-100%);
    -moz-transform: translateY(-100%);
    -o-transform: translateY(-100%);
    -ms-transform: translateY(-100%);
    transform: translateY(-100%);
  }

  50% {
    -webkit-transform: translateY(100%);
    -moz-transform: translateY(100%);
    -o-transform: translateY(100%);
    -ms-transform: translateY(100%);
    transform: translateY(100%);
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }

  51% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-webkit-keyframes bottom-to-top {
  49% {
    -webkit-transform: translateY(-100%);
    -moz-transform: translateY(-100%);
    -o-transform: translateY(-100%);
    -ms-transform: translateY(-100%);
    transform: translateY(-100%);
  }

  50% {
    -webkit-transform: translateY(100%);
    -moz-transform: translateY(100%);
    -o-transform: translateY(100%);
    -ms-transform: translateY(100%);
    transform: translateY(100%);
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }

  51% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-o-keyframes bottom-to-top {
  49% {
    -webkit-transform: translateY(-100%);
    -moz-transform: translateY(-100%);
    -o-transform: translateY(-100%);
    -ms-transform: translateY(-100%);
    transform: translateY(-100%);
  }

  50% {
    -webkit-transform: translateY(100%);
    -moz-transform: translateY(100%);
    -o-transform: translateY(100%);
    -ms-transform: translateY(100%);
    transform: translateY(100%);
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }

  51% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-ms-keyframes bottom-to-top {
  49% {
    -webkit-transform: translateY(-100%);
    -moz-transform: translateY(-100%);
    -o-transform: translateY(-100%);
    -ms-transform: translateY(-100%);
    transform: translateY(-100%);
  }

  50% {
    -webkit-transform: translateY(100%);
    -moz-transform: translateY(100%);
    -o-transform: translateY(100%);
    -ms-transform: translateY(100%);
    transform: translateY(100%);
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }

  51% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@keyframes bottom-to-top {
  49% {
    -webkit-transform: translateY(-100%);
    -moz-transform: translateY(-100%);
    -o-transform: translateY(-100%);
    -ms-transform: translateY(-100%);
    transform: translateY(-100%);
  }

  50% {
    -webkit-transform: translateY(100%);
    -moz-transform: translateY(100%);
    -o-transform: translateY(100%);
    -ms-transform: translateY(100%);
    transform: translateY(100%);
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }

  51% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-moz-keyframes top-to-bottom {
  49% {
    -webkit-transform: translateY(100%);
    -moz-transform: translateY(100%);
    -o-transform: translateY(100%);
    -ms-transform: translateY(100%);
    transform: translateY(100%);
  }

  50% {
    -webkit-transform: translateY(-100%);
    -moz-transform: translateY(-100%);
    -o-transform: translateY(-100%);
    -ms-transform: translateY(-100%);
    transform: translateY(-100%);
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }

  51% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-webkit-keyframes top-to-bottom {
  49% {
    -webkit-transform: translateY(100%);
    -moz-transform: translateY(100%);
    -o-transform: translateY(100%);
    -ms-transform: translateY(100%);
    transform: translateY(100%);
  }

  50% {
    -webkit-transform: translateY(-100%);
    -moz-transform: translateY(-100%);
    -o-transform: translateY(-100%);
    -ms-transform: translateY(-100%);
    transform: translateY(-100%);
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }

  51% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-o-keyframes top-to-bottom {
  49% {
    -webkit-transform: translateY(100%);
    -moz-transform: translateY(100%);
    -o-transform: translateY(100%);
    -ms-transform: translateY(100%);
    transform: translateY(100%);
  }

  50% {
    -webkit-transform: translateY(-100%);
    -moz-transform: translateY(-100%);
    -o-transform: translateY(-100%);
    -ms-transform: translateY(-100%);
    transform: translateY(-100%);
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }

  51% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-ms-keyframes top-to-bottom {
  49% {
    -webkit-transform: translateY(100%);
    -moz-transform: translateY(100%);
    -o-transform: translateY(100%);
    -ms-transform: translateY(100%);
    transform: translateY(100%);
  }

  50% {
    -webkit-transform: translateY(-100%);
    -moz-transform: translateY(-100%);
    -o-transform: translateY(-100%);
    -ms-transform: translateY(-100%);
    transform: translateY(-100%);
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }

  51% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@keyframes top-to-bottom {
  49% {
    -webkit-transform: translateY(100%);
    -moz-transform: translateY(100%);
    -o-transform: translateY(100%);
    -ms-transform: translateY(100%);
    transform: translateY(100%);
  }

  50% {
    -webkit-transform: translateY(-100%);
    -moz-transform: translateY(-100%);
    -o-transform: translateY(-100%);
    -ms-transform: translateY(-100%);
    transform: translateY(-100%);
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }

  51% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
.booking-list {
  list-style: none;
  padding: 0;
  margin-bottom: 30px;
}
.booking-list > li {
  margin-bottom: 15px;
  position: relative;
}
.booking-item {
  cursor: pointer;
  display: block;
  position: relative;
  padding: 17px;
  color: #000;
  -webkit-transition: 0.2s;
  -moz-transition: 0.2s;
  -o-transition: 0.2s;
  -ms-transition: 0.2s;
  transition: 0.2s;
}
.booking-item-container {
  border: 1px solid #e6e6e6;
  overflow: hidden;
}
.booking-item-container:hover,
.booking-item-container.active {
  color: #000;
  border: 1px solid <?php echo $themecolor;?>;
  -webkit-box-shadow: 0 2px 1px rgba(0,0,0,0.2);
  box-shadow: 0 2px 1px rgba(0,0,0,0.2);
}
.booking-item:hover .booking-item-number,
.booking-item.active .booking-item-number {
  background: #808080;
}
.booking-item:hover .booking-item-img-wrap .booking-item-img-num,
.booking-item.active .booking-item-img-wrap .booking-item-img-num {
  opacity: 1;
  -ms-filter: none;
  filter: none;
  background: rgba(0,0,0,0.5);
}
.booking-item.booking-item-small {
  padding: 11px;
}
.booking-item.booking-item-small .booking-item-title {
  font-size: 14px;
  margin-bottom: 0;
}
.booking-item.booking-item-small .booking-item-rating-stars {
  font-size: 12px;
  margin-bottom: 0;
  color: <?php echo $themecolor;?>;
}
.booking-item.booking-item-small .booking-item-price {
  font-size: 20px;
  font-weight: 400;
  margin-bottom: 2px;
  display: inline;
}
.booking-item.booking-item-small .booking-item-price-from {
  font-size: 12px;
  margin-bottom: 2px;
}
.booking-item-title {
  margin-bottom: 7px;
}
.booking-item-description {
  font-size: 13px;
  line-height: 1.5em;
}
.booking-item-img-wrap {
  position: relative;
}
.booking-item-img-wrap .booking-item-img-num {
  opacity: 0.5;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
  filter: alpha(opacity=50);
  -webkit-transition: 0.2s;
  -moz-transition: 0.2s;
  -o-transition: 0.2s;
  -ms-transition: 0.2s;
  transition: 0.2s;
  position: absolute;
  bottom: 0;
  right: 0;
  color: #fff;
  background: rgba(0,0,0,0.01);
  padding: 5px 7px;
  font-size: 13px;
  line-height: 1em;
}
.booking-item-img-wrap .booking-item-img-num > .fa {
  margin-right: 3px;
}
.booking-item-last-booked {
  font-size: 11px;
}
.booking-item-rating {
  margin-bottom: 3px;
  padding-bottom: 3px;
  border-bottom: 1px solid #f7f7f7;
  display: inline-block;
}
.booking-item-rating .booking-item-rating-stars {
  display: inline-block;
  margin-right: 17px;
  margin-bottom: -5px;
  color: <?php echo $themecolor;?>;
}
.booking-item-rating .booking-item-rating-stars .fa {
  margin-right: 0;
}
.booking-item-rating .booking-item-rating-number {
  margin-right: 7px;
}
.booking-item-rating .booking-item-rating-number > b {
  font-size: 25px;
}
.booking-item-address {
  line-height: 1em;
  font-size: 13px;
}
.booking-item-price-from {
  display: block;
  font-size: 12px;
  line-height: 1em;
}
.booking-item-price {
  font-size: 25px;
  color: #000;
  line-height: 1em;
  display: inline-block;
  margin-bottom: 12px;
}
.booking-item-number {
  position: absolute;
  width: 20px;
  height: 20px;
  line-height: 20px;
  background: #e6e6e6;
  text-align: center;
  color: #fff;
  display: block;
  top: 2px;
  right: 2px;
  font-size: 10px;
  -webkit-transform: translate3d(0, 0, 0);
  -moz-transform: translate3d(0, 0, 0);
  -o-transform: translate3d(0, 0, 0);
  -ms-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
  -webkit-transition: 0.2s;
  -moz-transition: 0.2s;
  -o-transition: 0.2s;
  -ms-transition: 0.2s;
  transition: 0.2s;
}
.booking-item-flight-details {
  overflow: hidden;
}
.booking-item-flight-details .booking-item-departure,
.booking-item-flight-details .booking-item-arrival {
  float: left;
  width: 47%;
}
.booking-item-flight-details .booking-item-departure .fa-plane,
.booking-item-flight-details .booking-item-arrival .fa-plane {
  float: left;
  display: block;
  font-size: 30px;
  margin-right: 5px;
  position: relative;
  top: 4px;
}
.booking-item-flight-details .booking-item-departure h5,
.booking-item-flight-details .booking-item-arrival h5 {
  margin-bottom: 0;
}
.booking-item-flight-details .booking-item-departure .booking-item-date,
.booking-item-flight-details .booking-item-arrival .booking-item-date {
  margin-bottom: 7px;
  font-size: 12px;
  line-height: 1em;
  padding-left: 32px;
}
.booking-item-flight-details .booking-item-departure {
  margin-right: 6%;
}
.booking-item-flight-details .booking-item-destination {
  font-size: 12px;
  line-height: 1.3em;
}
.booking-item-airline-logo > p {
  margin-bottom: 0;
  font-size: 12px;
  margin-top: 5px;
  line-height: 1.3em;
}
 
.booking-item-flight-class {
  margin-bottom: 7px;
  margin-top: -5px;
  font-size: 11px;
  color: #8f8f8f;
  line-height: 1em;
}
.booking-item-features {
  list-style: none;
  margin: 0;
  padding: 0;
}
.booking-item-features > li {
  float: left;
  position: relative;
  margin-right: 7px;
  margin-bottom: 7px;
}
.booking-item-features > li:hover > i {
  border-color: #d66f11;
}
.booking-item-features > li .booking-item-feature-sign {
  position: absolute;
  bottom: 2px;
  left: 0;
  display: block;
  text-align: center;
  font-size: 10px;
  line-height: 1em;
  width: 100%;
}
.booking-item-features > li > i {
  height: 35px;
  width: 35px;
  text-align: center;
  line-height: 35px;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
  font-size: 23px;
  display: block;
  -webkit-border-radius: 5px;
  border-radius: 5px;
  border: 1px solid #ccc;
  color: #686868;
}
.booking-item-features-dark > li > i {
  background: #4d4d4d;
  border: 1px solid #333;
  color: #fff;
}
.booking-item-features-rentals {
  margin-top: 10px;
}
.booking-item-features-rentals > li {
  margin-bottom: 0;
}
.booking-item-car-title {
  margin-top: 7px;
  font-size: 12px;
  line-height: 1em;
  margin-bottom: 0;
}
.booking-item-features-sign > li {
  padding-bottom: 15px;
}
.booking-item-features-small > li {
  margin-right: 5px;
  margin-bottom: 5px;
}
.booking-item-features-small > li > i {
  width: 30px;
  height: 30px;
  line-height: 30px;
  font-size: 17px;
}
 
.booking-item-features-expand {
  display: block;
}
.booking-item-features-expand .booking-item-feature-title {
  position: relative;
  line-height: 37px;
  margin-left: 7px;
  color: #686868;
}
.booking-item-features-expand > li {
  float: none;
  display: block;
  overflow: hidden;
}
.booking-item-features-expand > li:after {
  content: '.';
  display: block;
  height: 0;
  clear: both;
  visibility: hidden;
}
.booking-item-features-expand > li > i {
  float: left;
}
.booking-item-features-2-col > li {
  float: left;
  width: 50%;
  margin-right: 0;
}
.booking-item-container .booking-item-details {
  height: 0;
  overflow: hidden;
  -webkit-transition: opacity 0.3s, -webkit-transform 0.3s, height 0.3s;
  -moz-transition: opacity 0.3s, -moz-transform 0.3s, height 0.3s;
  -o-transition: opacity 0.3s, -o-transform 0.3s, height 0.3s;
  -ms-transition: opacity 0.3s, -ms-transform 0.3s, height 0.3s;
  transition: opacity 0.3s, transform 0.3s, height 0.3s;
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transform: translate3d(0, -10px, 0);
  -moz-transform: translate3d(0, -10px, 0);
  -o-transform: translate3d(0, -10px, 0);
  -ms-transform: translate3d(0, -10px, 0);
  transform: translate3d(0, -10px, 0);
}
/*.booking-item-container .booking-item-details h5 {
  font-size: 13px;
  font-weight: 400;
  margin-bottom: 20px;
}*/
.booking-item-container .booking-item-details h5.list-title {
  margin-bottom: 0;
}
.booking-item-container .booking-item-details .list {
  margin-bottom: 20px;
}
.booking-item-container.active .booking-item-details {
  height: auto;
  overflow: auto;
  padding: 15px;
  border: 1px solid #e6e6e6;
  border-top: none;
  position: relative;
  font-size: 11px;
  line-height: 1.6em;
  opacity: 1;
  -ms-filter: none;
  filter: none;
  -webkit-transform: translate3d(0, 0, 0);
  -moz-transform: translate3d(0, 0, 0);
  -o-transform: translate3d(0, 0, 0);
  -ms-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
  border-right: none;
  border-top: 1px solid #e6e6e6;
}
.booking-title {
  margin-bottom: 25px;
  margin-top: 15px;
}
.booking-title > small {
  font-size: 12px;
  margin-left: 5px;
}
.booking-filters {
  -webkit-border-radius: 5px;
  border-radius: 5px;
  font-size: 11px;
  background: #4d4d4d;
  color: #fff;
  padding: 15px 0;

  border: 1px solid #262626;
}
.booking-filters > h3, .booking-filters > h4 {
  padding: 0 20px;
}
.booking-filters .booking-filters-list > li {
  margin-top: 15px;
  padding: 15px 20px 0 20px;
  border-top: 1px solid #3b3b3b;
}
.booking-filters .booking-filters-list > li .booking-filters-title {
  margin-bottom: 5px;
}
.booking-filters .booking-filters-list > li .booking-filters-title small {
  font-size: 11px;
  font-weight: 400;
  position: relative;
  top: 10px;
  float: right;
  line-height: 1.3em;
  color: #ccc;
}
.booking-filters .booking-filters-list > li .booking-filters-sub-title {
  font-size: 15px;
  line-height: 1em;
  margin-top: 10px;
}
.booking-filters .irs-from,
.booking-filters .irs-to,
.booking-filters .irs-single {
  color: #fff;
}
.booking-filters .irs-grid-text {
  color: #000;
}
.booking-filters.booking-filters-white {
  color: #000;
  background: #fafafa;
  border-color: #ccc;
}
.booking-filters.booking-filters-white .irs-from,
.booking-filters.booking-filters-white .irs-to,
.booking-filters.booking-filters-white .irs-single {
  color: #000;
}
.booking-filters.booking-filters-white .booking-filters-list > li {
  border-color: #ccc;
}
.booking-sort {
  font-size: 10px;
}
.booking-sort .booking-sort-title {
  font-size: 14px;
}
.booking-sort .booking-sort-title > a {
  color: #000;
}
.booking-item-meta .booking-item-rating {
  border: none;
  padding: 0;
  margin-bottom: 30px;
  display: block;
}
.booking-item-meta .booking-item-rating-stars {
  font-size: 30px;
  margin-bottom: -3px;
  margin-right: 10px;
}
.booking-item-meta .booking-item-rating-number {
  font-size: 20px;
}
.booking-item-meta .booking-item-rating-number b {
  font-size: 30px;
}
.booking-item-raiting-list,
.booking-item-raiting-summary-list {
  font-size: 13px;
  margin-bottom: 30px;
}
.booking-item-raiting-list > li,
.booking-item-raiting-summary-list > li {
  margin-bottom: 5px;
  overflow: hidden;
}
.booking-item-raiting-list > li > div,
.booking-item-raiting-summary-list > li > div {
  height: 26px;
  float: left;
  line-height: 26px;
}
.booking-item-raiting-list > li > div.booking-item-raiting-list-title,
.booking-item-raiting-summary-list > li > div.booking-item-raiting-list-title {
  width: 24%;
}
.booking-item-raiting-list > li > div.booking-item-raiting-list-bar,
.booking-item-raiting-summary-list > li > div.booking-item-raiting-list-bar {
  width: 60%;
  background: #e6e6e6;
  height: 20px;
  margin-top: 3px;
}
.booking-item-raiting-list > li > div.booking-item-raiting-list-bar > div,
.booking-item-raiting-summary-list > li > div.booking-item-raiting-list-bar > div {
  background: <?php echo $themecolor;?>;
  height: 100%;
}
.booking-item-raiting-list > li > div.booking-item-raiting-list-number,
.booking-item-raiting-summary-list > li > div.booking-item-raiting-list-number {
  margin-left: 2%;
  width: 10%;
}
.booking-item-raiting-summary-list > li > div.booking-item-raiting-list-title {
  width: 48%;
}
.booking-item-raiting-summary-list > li .booking-item-rating-stars {
  font-size: 14px;
  line-height: 26px;
  margin: 0;
  color: <?php echo $themecolor;?>;
}
.booking-item-reviews > li {
  margin-bottom: 20px;
}
.booking-item-reviews > li .booking-item-review-person p {
  line-height: 1em;
}
.booking-item-reviews > li .booking-item-review-person-avatar {
  display: table;
  margin-bottom: 8px;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
.booking-item-reviews > li .booking-item-review-person-avatar:hover {
  -webkit-box-shadow: 0 0 0 2px <?php echo $themecolor;?>;
  box-shadow: 0 0 0 2px <?php echo $themecolor;?>;
}
.booking-item-reviews > li .booking-item-review-person-avatar > img {
  max-width: 70px;
}
.booking-item-reviews > li .booking-item-review-person-name {
  margin-bottom: 5px;
}
.booking-item-reviews > li .booking-item-review-person-loc {
  margin-bottom: 0px;
  font-size: 11px;
}
.booking-item-reviews > li .booking-item-review-content {
  padding: 15px 17px;
  border: 1px solid #e6e6e6;
  position: relative;
  -webkit-transition: 0.2s;
  -moz-transition: 0.2s;
  -o-transition: 0.2s;
  -ms-transition: 0.2s;
  transition: 0.2s;
}
.booking-item-reviews > li .booking-item-review-content:before {
  z-index: 2;
  content: '';
  position: absolute;
  width: 0;
  height: 0;
  border-top: 15px solid transparent;
  border-right: 20px solid #ededed;
  border-bottom: 15px solid transparent;
  left: -20px;
  top: 14px;
}
.booking-item-reviews > li .booking-item-review-content > h5 {
  margin-bottom: 0;
}
.booking-item-reviews > li .booking-item-review-content .booking-item-raiting-summary-list > li > div.booking-item-raiting-list-title {
  width: 75px;
}
.booking-item-reviews > li .booking-item-review-content .booking-item-raiting-summary-list > li .booking-item-rating-stars {
  margin-bottom: 0;
}
.booking-item-reviews > li .booking-item-review-content .booking-item-review-more,
.booking-item-reviews > li .booking-item-review-content .booking-item-review-more-content {
  display: none;
  -webkit-transition: 0.2s;
  -moz-transition: 0.2s;
  -o-transition: 0.2s;
  -ms-transition: 0.2s;
  transition: 0.2s;
}
.booking-item-reviews > li .booking-item-review-content .booking-item-review-expand {
  position: relative;
  height: 30px;
  cursor: pointer;
}
.booking-item-reviews > li .booking-item-review-content .booking-item-review-expand span {
  color: <?php echo $themecolor;?>;
  line-height: 30px;
  height: 30px;
  display: block;
  position: absolute;
  font-size: 14px;
}
.booking-item-reviews > li .booking-item-review-content .booking-item-review-expand span.booking-item-review-expand-less {
  display: none;
}
.booking-item-reviews > li .booking-item-review-content.expanded .booking-item-review-more {
  display: inline;
}
.booking-item-reviews > li .booking-item-review-content.expanded .booking-item-review-more-content {
  display: block;
}
.booking-item-reviews > li .booking-item-review-content.expanded .booking-item-review-expand	span.booking-item-review-expand-less {
  display: block;
}
.booking-item-reviews > li .booking-item-review-content.expanded .booking-item-review-expand	span.booking-item-review-expand-more {
  display: none;
}
.booking-item-reviews > li .booking-item-raiting-summary-list {
  margin-bottom: 10px;
}
.booking-item-reviews > li .booking-item-rating-stars {
  font-size: 14px;
  color: <?php echo $themecolor;?>;
  margin-bottom: 5px;
}
.booking-item-reviews > li .booking-item-review-rate {
  line-height: 30px;
  font-size: 12px;
  margin-bottom: 0;
}
.booking-item-reviews > li .booking-item-review-rate .fa {
  margin-left: 7px;
}
.booking-item-raiting-summary-list.stats-list-select > li .booking-item-rating-stars {
  color: #b3b3b3;
}
.booking-item-raiting-summary-list.stats-list-select > li .booking-item-rating-stars > li {
  cursor: pointer;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
.booking-item-raiting-summary-list.stats-list-select > li .booking-item-rating-stars > li.hovered {
  color: #808080;
}
.booking-item-raiting-summary-list.stats-list-select > li .booking-item-rating-stars > li.selected {
  color: <?php echo $themecolor;?>;
}
.booking-item-deails-date-location {
  padding: 15px 17px;
  background: #f7f7f7;
  -webkit-border-radius: 5px;
  border-radius: 5px;
  border: 1px solid <?php echo $themecolor;?>;
}
.booking-item-deails-date-location > ul {
  font-size: 12px;
  list-style: none;
  margin: 0 0 30px 0;
  padding: 0;
}
.booking-item-deails-date-location > ul > li {
  margin-bottom: 15px;
}
.booking-item-deails-date-location > ul > li p {
  margin-bottom: 5px;
}
.booking-item-deails-date-location > ul > li p > i {
  margin-right: 7px;
  height: 23px;
  width: 23px;
  line-height: 23px;
  font-size: 11px;
}
.booking-item-deails-date-location > ul > li h5 {
  font-size: 14px;
  margin-bottom: 5px;
  color: #515151;
}
.booking-item-price-calc {
  font-size: 13px;
}
.booking-item-price-calc .checkbox {
  margin-bottom: 5px;
  margin-top: 0;
}
.booking-item-price-calc .checkbox label {
  font-weight: 100;
}
.booking-item-price-calc .icheck {
  width: 20px;
  height: 20px;
  line-height: 18px;
  top: 2px;
}
.booking-item-price-calc .list {
  margin-bottom: 10px;
}
.booking-item-price-calc .list > li {
  margin-bottom: 7px;
}
.booking-item-price-calc .list > li > small {
  display: block;
  font-size: 11px;
}
.booking-item-price-calc .list > li > p {
  height: 25px;
  line-height: 25px;
  margin-bottom: 0;
}
.booking-item-price-calc .list > li > p span {
  float: right;
}
.booking-item-price-calc .list > li:last-child {
  padding-top: 7px;
  border-top: 1px solid #ccc;
  color: #5c5c5c;
}
.booking-item-price-calc .list > li:last-child > p > span {
  font-size: 15px;
  font-weight: 600;
}
.booking-item-passengers > li {
  margin-top: 20px;
  padding-top: 20px;
  border-top: 2px solid #e6e6e6;
}
.booking-item-passengers > li:last-child {
  margin-bottom: 20px;
  padding-bottom: 20px;
  border-bottom: 2px solid #e6e6e6;
}
.booking-item-passengers label {
  font-weight: bold;
  font-size: 13px;
  text-transform: uppercase;
}
.booking-item-payment-total-flight {
  list-style: none;
  margin: 0;
  padding: 0;
  background: #f2f2f2;
  margin-right: 30px;
}
.booking-item-payment-total-flight > li {
  padding: 10px 15px;
  background: #4d4d4d;
  color: #e6e6e6;
}
.booking-item-payment-total-flight > li:first-child {
  border-bottom: 1px dashed #1a1a1a;
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 5px 5px 0 0;
}
.booking-item-payment-total-flight > li:first-child > h5 {
  line-height: 1em;
  margin: 3px 0;
  color: #f09644;
}
.booking-item-payment-total-flight > li:last-child {
  -webkit-border-radius: 0 0 5px 5px;
  border-radius: 0 0 5px 5px;
}
.booking-item-payment-total-flight > li.booking-item-payment-total-flight-wait {
  background: #333;
}
.booking-item-payment-total-flight > li.booking-item-payment-total-flight-wait > p {
  font-size: 13px;
  line-height: 1.4em;
  margin: 0;
  text-align: center;
}
.booking-item-payment-total-flight > li h5 {
  color: #fff;
}
.booking-item-payment-total-flight > li .booking-item-flight-details .booking-item-departure .fa-plane,
.booking-item-payment-total-flight > li .booking-item-flight-details .booking-item-arrival .fa-plane {
  font-size: 20px;
}
.booking-item-payment-total-flight > li .booking-item-flight-details .booking-item-departure h5,
.booking-item-payment-total-flight > li .booking-item-flight-details .booking-item-arrival h5 {
  font-size: 14px;
}
.booking-item-payment-total-flight > li .booking-item-flight-details .booking-item-departure .booking-item-date,
.booking-item-payment-total-flight > li .booking-item-flight-details .booking-item-arrival .booking-item-date {
  padding-left: 23px;
  font-size: 11px;
}
.booking-item-payment-total-flight > li .booking-item-flight-details .booking-item-destination {
  font-size: 12px;
}
.booking-item-payment-total-flight > li .booking-item-flight-duration > p {
  margin-bottom: 5px;
  line-height: 1em;
  font-size: 13px;
}
.booking-item-payment-total-flight > li .booking-item-flight-duration > h5 {
  font-weight: 400;
}
.booking-item-payment-flight .booking-item-flight-details .booking-item-departure .fa-plane,
.booking-item-payment-flight .booking-item-flight-details .booking-item-arrival .fa-plane {
  font-size: 20px;
}
.booking-item-payment-flight .booking-item-flight-details .booking-item-departure h5,
.booking-item-payment-flight .booking-item-flight-details .booking-item-arrival h5 {
  font-size: 14px;
}
.booking-item-payment-flight .booking-item-flight-details .booking-item-departure .booking-item-date,
.booking-item-payment-flight .booking-item-flight-details .booking-item-arrival .booking-item-date {
  padding-left: 23px;
  font-size: 11px;
}
.booking-item-payment-flight .booking-item-flight-details .booking-item-destination {
  font-size: 12px;
}
.booking-item-payment-flight .booking-item-flight-duration > p {
  margin-bottom: 5px;
  line-height: 1em;
  font-size: 13px;
}
.booking-item-payment-flight .booking-item-flight-duration > h5 {
  font-weight: 400;
}
.booking-item-dates-change {
  -webkit-border-radius: 5px;
  border-radius: 5px;
  padding: 15px 20px;
  border: 1px solid <?php echo $themecolor;?>;
  -webkit-box-shadow: 0 2px 1px rgba(0,0,0,0.15);
  box-shadow: 0 2px 1px rgba(0,0,0,0.15);
}
.booking-item-payment {
  -webkit-box-shadow: 0 2px 1px rgba(0,0,0,0.1);
  box-shadow: 0 2px 1px rgba(0,0,0,0.1);
  border: 1px solid rgba(0,0,0,0.15);
}
.booking-item-payment > header {
  padding: 10px 15px;
  background: #f7f7f7;
}
.booking-item-payment > header .booking-item-payment-img {
  float: left;
  display: block;
  width: 30%;
  margin-right: 5%;
}
.booking-item-payment > header .booking-item-payment-title {
  font-size: 14px;
  margin-bottom: 0;
}
.booking-item-payment > header .booking-item-rating-stars {
  font-size: 11px;
}
.booking-item-payment .booking-item-payment-total {
  margin-bottom: 0;
  padding: 8px 30px 8px 15px;
  font-size: 12px;
  font-weight: bold;
}
.booking-item-payment .booking-item-payment-total > span {
  font-size: 24px;
  color: #686868;
  font-weight: 400;
  letter-spacing: -2px;
}
.booking-item-payment .booking-item-payment-details {
  list-style: none;
  margin: 0;
  padding: 15px;
  font-weight: bold;
  border-top: 1px solid #d9d9d9;
  border-bottom: 1px solid #d9d9d9;
}
.booking-item-payment .booking-item-payment-details > li {
  margin-bottom: 20px;
  overflow: hidden;
}
.booking-item-payment .booking-item-payment-details > li:last-child {
  margin-bottom: 0;
}
.booking-item-payment .booking-item-payment-details > li > h5 {
  line-height: 1em;
}
.booking-item-payment .booking-item-payment-details > li > p {
  margin-bottom: 0;
  color: #686868;
}
.booking-item-payment .booking-item-payment-details > li .booking-item-payment-item-title {
  color: #515151;
}
.booking-item-payment .booking-item-payment-details > li .booking-item-payment-date,
.booking-item-payment .booking-item-payment-details > li .booking-item-payment-date-separator {
  float: left;
  display: block;
}
.booking-item-payment .booking-item-payment-details > li .booking-item-payment-date-separator {
  width: 15%;
  text-align: center;
}
.booking-item-payment .booking-item-payment-details > li .booking-item-payment-date .booking-item-payment-date-day {
  margin-bottom: 5px;
  line-height: 1em;
  color: #686868;
}
.booking-item-payment .booking-item-payment-details > li .booking-item-payment-date .booking-item-payment-date-weekday {
  font-size: 12px;
  margin-bottom: 0;
  line-height: 1em;
  color: #7a7a7a;
}
.booking-item-payment .booking-item-payment-details > li .booking-item-payment-price {
  margin: 0;
  padding: 0;
  list-style: none;
}
.booking-item-payment .booking-item-payment-details > li .booking-item-payment-price > li {
  width: 70%;
  overflow: hidden;
  font-size: 12px;
  border-bottom: 1px dashed #d9d9d9;
}
.booking-item-payment .booking-item-payment-details > li .booking-item-payment-price > li .booking-item-payment-price-title,
.booking-item-payment .booking-item-payment-details > li .booking-item-payment-price > li .booking-item-payment-price-amount {
  float: left;
  margin: 0;
}
.booking-item-payment .booking-item-payment-details > li .booking-item-payment-price > li .booking-item-payment-price-amount {
  float: right;
}
.booking-item-payment .booking-item-payment-details > li .booking-item-payment-price > li .booking-item-payment-price-amount > small {
  margin-left: 3px;
}
.booking-item-details .booking-item-header {
  margin-bottom: 20px;
  margin-top: 15px;
  padding-top: 15px;
  border-top: 1px solid #f2f2f2;
}
.booking-item-details .booking-item-header-price {
  font-size: 19px;
  text-align: right;
  line-height: 1em;
}
.booking-item-details .booking-item-header-price .text-lg {
  font-size: 42px;
  line-height: 1em;
}
.booking-item-details .booking-item-header-price small {
  font-size: 13px;
}
.booking-details-tabbable .nav > li > a > .fa {
  margin-right: 5px;
  opacity: 0.6;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=60)";
  filter: alpha(opacity=60);
  font-size: 13px;
  position: relative;
  top: -1px;
}
.booking-details-tabbable .nav > li.active > a > .fa {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.booking-list-wishlist > li {
  padding-top: 30px;
  padding-right: 25px;
}
.booking-list-wishlist > li .booking-item-wishlist-title {
  position: absolute;
  top: 0;
  left: 0;
  height: 30px;
  line-height: 30px;
  padding: 0 10px;
  border: 1px solid #f2f2f2;
  background: #f7f7f7;
  border-bottom: none;
  font-size: 12px;
  -webkit-border-radius: 3px 3px 0 0;
  border-radius: 3px 3px 0 0;
}
.booking-list-wishlist > li .booking-item-wishlist-title > span {
  font-size: 9px;
  color: #8f8f8f;
  margin-left: 5px;
}
.booking-list-wishlist > li .booking-item-wishlist-remove {
  position: absolute;
  top: 30px;
  right: 0;
  display: block;
  width: 25px;
  height: 25px;
  line-height: 25px;
  background: #e6e6e6;
  color: #000;
  text-align: center;
  -webkit-transition: 0.1s;
  -moz-transition: 0.1s;
  -o-transition: 0.1s;
  -ms-transition: 0.1s;
  transition: 0.1s;
}
.booking-list-wishlist > li .booking-item-wishlist-remove:hover {
  background: #4d4d4d;
  color: #fff;
}
.user-profile-sidebar {
  -webkit-border-radius: 5px;
  border-radius: 5px;
  margin-right: 30px;
  padding: 20px 0;
  background: #4d4d4d;
  color: #fff;
  margin-bottom: 30px;
}
.user-profile-sidebar .user-profile-avatar {
  padding: 0 20px;
  margin-bottom: 20px;
}
.user-profile-sidebar .user-profile-avatar img {
  max-width: 120px;
  margin-bottom: 15px;
  -webkit-border-radius: 50%;
  border-radius: 50%;
}
.user-profile-sidebar .user-profile-avatar h5 {
  color: #fff;
  margin-bottom: 0;
  font-size: 16px;
}
.user-profile-sidebar .user-profile-avatar p {
  font-size: 10px;
}
.user-profile-sidebar .user-profile-nav > li {
  border-bottom: 1px solid #404040;
}
.user-profile-sidebar .user-profile-nav > li:first-child {
  border-top: 1px solid #404040;
}
.user-profile-sidebar .user-profile-nav > li.active > a {
  background: <?php echo $themecolor;?>;
  color: #fff;
  cursor: default;
}
.user-profile-sidebar .user-profile-nav > li.active > a:hover {
  background: <?php echo $themecolor;?>;
  color: #fff;
}
.user-profile-sidebar .user-profile-nav > li.active > a:hover > i {
  color: #fff;
}
.user-profile-sidebar .user-profile-nav > li > a {
  padding: 10px 20px;
  color: #d9d9d9;
  display: block;
  font-size: 13px;
}
.user-profile-sidebar .user-profile-nav > li > a:hover {
  color: #fff;
  background: #404040;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
.user-profile-sidebar .user-profile-nav > li > a:hover > i {
  color: <?php echo $themecolor;?>;
}
.user-profile-sidebar .user-profile-nav > li > a > i {
  margin-right: 7px;
  display: inline-block;
  width: 20px;
  text-align: center;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
.user-profile-statictics > li {
  margin-right: 20px;
  text-align: center;
  padding: 20px;
  border: 1px solid #e6e6e6;
  -webkit-border-radius: 5px;
  border-radius: 5px;
  width: 153px;
}
.user-profile-statictics > li:last-child {
  margin-right: 0;
}
.user-profile-statictics > li .user-profile-statictics-icon {
  font-size: 70px;
  display: inline-block;
  margin-bottom: 10px;
  color: #8c8c8c;
}
.user-profile-statictics > li h5 {
  font-size: 30px;
  margin-bottom: 0;
  line-height: 1em;
  margin-bottom: 3px;
  color: <?php echo $themecolor;?>;
}
.user-profile-statictics > li p {
  margin-bottom: 0;
  line-height: 1em;
  font-size: 13px;
}
.table-booking-history {
  font-size: 12px;
}
.table-booking-history .booking-history-type {
  text-align: center;
}
.table-booking-history .booking-history-type > i {
  display: block;
  font-size: 25px;
  color: #626262;
  margin-bottom: 2px;
}
.table-booking-history .booking-history-type > small {
  line-height: 1em;
  display: block;
}
.table-booking-history .booking-history-title {
  width: 22%;
  color: #000000;
}
.irs {
  position: relative;
  display: block;
  height: 40px;
}
.irs-line {
  position: relative;
  display: block;
  overflow: hidden;
  height: 12px;
  top: 25px;
  background: #ccc;
}
.irs-line-left,
.irs-line-mid,
.irs-line-right {
  position: absolute;
  display: block;
  top: 0;
  height: 12px;
}
.irs-line-left {
  left: 0;
  width: 10%;
}
.irs-line-mid {
  left: 10%;
  width: 10%;
}
.irs-line-right {
  right: 0;
  width: 10%;
}
.irs-diapason {
  position: absolute;
  display: block;
  left: 0;
  width: 100%;
  height: 12px;
  top: 25px;
  background: <?php echo $themecolor;?>;
}
.irs-slider {
  position: absolute;
  display: block;
  left: 0;
  width: 5px;
  height: 18px;
  top: 22px;
  background: <?php echo $themecolordark;?>;
  cursor: pointer;
}
.irs-slider.single {
  left: 10px;
}
.irs-slider.single:before {
  content: '';
  position: absolute;
  display: block;
  top: -30%;
  left: -30%;
  width: 160%;
  height: 160%;
}
.irs-slider.from {
  left: 100px;
}
.irs-slider.from:before {
  content: '';
  position: absolute;
  display: block;
  top: -30%;
  left: 0;
  width: 200%;
  height: 170%;
}
.irs-slider.to {
  left: 300px;
}
.irs-slider.to:before {
  content: '';
  position: absolute;
  display: block;
  top: -30%;
  right: 0;
  width: 200%;
  height: 170%;
}
.irs-slider.last {
  z-index: 2;
}
.irs-min,
.irs-max {
  position: absolute;
  display: block;
  cursor: default;
  color: #b3b3b3;
  font-size: 10px;
  line-height: 1.333;
  top: 4px;
}
.irs-min {
  left: 0;
}
.irs-max {
  right: 0;
}
.irs-from,
.irs-to,
.irs-single {
  position: absolute;
  display: block;
  top: 2px;
  left: 0;
  cursor: default;
  white-space: nowrap;
  color: #666;
  font-size: 13px;
  line-height: 1.333;
}
.irs-grid {
  position: absolute;
  display: none;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 20px;
}
.irs-with-grid {
  height: 60px;
}
.irs-with-grid .irs-grid {
  display: block;
}
.irs-grid-pol {
  position: absolute;
  top: 0;
  left: 0;
  width: 1px;
  height: 8px;
  background: #b3b3b3;
}
.irs-grid-pol.small {
  height: 4px;
}
.irs-grid-text {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100px;
  white-space: nowrap;
  text-align: center;
  font-size: 9px;
  line-height: 9px;
  color: #808080;
}
.irs-disable-mask {
  position: absolute;
  display: block;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  cursor: default;
  background: #000;
  z-index: 2;
}
.irs-disabled {
  opacity: 0.4;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=40)";
  filter: alpha(opacity=40);
}
.i-check,
.i-radio {
  display: inline-block;
  *display: inlne;
  vertical-align: middle;
  border-radius: 18px;
  margin: 0;
  padding: 0;
  width: 22px;
  height: 22px;
  border: 1px solid #ccc;
  cursor: pointer;
  top: 1px;
  left: -7px;
  margin-left: -13px;
  float: left;
  text-align: center;
  line-height: 20px;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
  position: relative;
  overflow: hidden;
}
.i-check:before,
.i-radio:before {
  content: '\f00c';
  font-family: 'FontAwesome';
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
  -webkit-transform: translate3d(0, -25px, 0);
  -moz-transform: translate3d(0, -25px, 0);
  -o-transform: translate3d(0, -25px, 0);
  -ms-transform: translate3d(0, -25px, 0);
  transform: translate3d(0, -25px, 0);
  display: block;
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  color: #fff;
  font-size: 14px;
}
.i-check.hover,
.i-radio.hover {
  border: 1px solid <?php echo $themecolor;?>;
}
.i-check.checked,
.i-radio.checked {
  border: 1px solid <?php echo $themecolor;?>;
  background: <?php echo $themecolor;?>;
}
.i-check.checked:before,
.i-radio.checked:before {
  -webkit-transform: translate3d(0, 0, 0);
  -moz-transform: translate3d(0, 0, 0);
  -o-transform: translate3d(0, 0, 0);
  -ms-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.i-check.disabled,
.i-radio.disabled {
  border-color: #d9d9d9 !important;
}
.i-check.disabled.checked,
.i-radio.disabled.checked {
  background: #ccc !important;
}
.i-check.i-check-stroke.checked {
  background: #fff;
}
.i-check.i-check-stroke.checked:before {
  color: <?php echo $themecolor;?>;
}
.i-radio {
  -webkit-border-radius: 50%;
  border-radius: 50%;
}
.i-radio:before {
  content: '\f111';
  font-size: 12px;
}
.checkbox-switch .i-check,
.radio-switch .i-check,
.checkbox-switch .i-radio,
.radio-switch .i-radio {
  -webkit-border-radius: 0;
  border-radius: 0;
  width: 44px;
  broder-color: #999;
  border-width: 2px;
}
.checkbox-switch .i-check:before,
.radio-switch .i-check:before,
.checkbox-switch .i-radio:before,
.radio-switch .i-radio:before {
  opacity: 1;
  -ms-filter: none;
  filter: none;
  -webkit-transform: translate3d(0, 0, 0);
  -moz-transform: translate3d(0, 0, 0);
  -o-transform: translate3d(0, 0, 0);
  -ms-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
  background: #b3b3b3;
  content: '';
  width: 16px;
  height: 14px;
  top: 2px;
  left: 2px;
  position: absolute;
}
.checkbox-switch .i-check.checked,
.radio-switch .i-check.checked,
.checkbox-switch .i-radio.checked,
.radio-switch .i-radio.checked {
  background: #fff;
}
.checkbox-switch .i-check.checked:before,
.radio-switch .i-check.checked:before,
.checkbox-switch .i-radio.checked:before,
.radio-switch .i-radio.checked:before {
  background: <?php echo $themecolor;?>;
  -webkit-transform: translate3d(20px, 0, 0);
  -moz-transform: translate3d(20px, 0, 0);
  -o-transform: translate3d(20px, 0, 0);
  -ms-transform: translate3d(20px, 0, 0);
  transform: translate3d(20px, 0, 0);
}
.checkbox-switch .i-check.disabled:before,
.radio-switch .i-check.disabled:before,
.checkbox-switch .i-radio.disabled:before,
.radio-switch .i-radio.disabled:before {
  background: #ccc !important;
}
.checkbox-small,
.radio-small {
  margin-bottom: 10px;
}
.checkbox-small.checkbox-inline,
.radio-small.checkbox-inline,
.checkbox-small.radio-inline,
.radio-small.radio-inline {
  margin: 0;
}
.checkbox-small label,
.radio-small label {
  font-size: 12px;
}
.checkbox-small label .i-check,
.radio-small label .i-check,
.checkbox-small label .i-radio,
.radio-small label .i-radio {
  width: 18px;
  height: 18px;
  line-height: 16px;
  top: 3px;
}
.checkbox-small label .i-check:before,
.radio-small label .i-check:before,
.checkbox-small label .i-radio:before,
.radio-small label .i-radio:before {
  font-size: 12px;
}
.checkbox-small label .i-radio:before,
.radio-small label .i-radio:before {
  font-size: 9px;
}
.checkbox-lg,
.radio-lg {
  margin-bottom: 20px;
}
.checkbox-lg.checkbox-inline,
.radio-lg.checkbox-inline,
.checkbox-lg.radio-inline,
.radio-lg.radio-inline {
  margin: 0;
}
.checkbox-lg label,
.radio-lg label {
  font-size: 16px;
}
.checkbox-lg label .i-check,
.radio-lg label .i-check,
.checkbox-lg label .i-radio,
.radio-lg label .i-radio {
  width: 26px;
  height: 26px;
  line-height: 24px;
  top: -1px;
}
.checkbox-lg label .i-check:before,
.radio-lg label .i-check:before,
.checkbox-lg label .i-radio:before,
.radio-lg label .i-radio:before {
  font-size: 16px;
}
.checkbox-lg label .i-radio:before,
.radio-lg label .i-radio:before {
  font-size: 14px;
}
.checkbox-stroke .i-check.checked,
.radio-stroke .i-check.checked,
.checkbox-stroke .i-radio.checked,
.radio-stroke .i-radio.checked {
  background: #fff;
}
.checkbox-stroke .i-check.checked:before,
.radio-stroke .i-check.checked:before,
.checkbox-stroke .i-radio.checked:before,
.radio-stroke .i-radio.checked:before {
  color: <?php echo $themecolor;?>;
}
.checkbox-stroke .i-check.checked.disabled,
.radio-stroke .i-check.checked.disabled,
.checkbox-stroke .i-radio.checked.disabled,
.radio-stroke .i-radio.checked.disabled {
  background: #fff;
}
.checkbox-stroke .i-check.checked.disabled:before,
.radio-stroke .i-check.checked.disabled:before,
.checkbox-stroke .i-radio.checked.disabled:before,
.radio-stroke .i-radio.checked.disabled:before {
  color: #ccc;
}
.checkbox-small.checkbox-inline + .checkbox-small.checkbox-inline,
.radio-small.radio-inline + .radio-small.radio-inline {
  margin-left: 10px;
}
.checkbox-lg.checkbox-inline + .checkbox-lg.checkbox-inline,
.radio-lg.radio-inline + .radio-lg.radio-inline {
  margin-left: 20px;
}
.fotorama__html,
.fotorama__stage__frame,
.fotorama__stage__shaft,
.fotorama__video iframe {
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  right: 0;
  left: 0;
  bottom: 0;
}
.fotorama--fullscreen,
.fotorama__img {
  max-width: 99999px !important;
  max-height: 99999px !important;
  min-width: 0 !important;
  min-height: 0 !important;
  -webkit-border-radius: 0 !important;
  border-radius: 0 !important;
  -webkit-box-shadow: none !important;
  box-shadow: none !important;
  padding: 0 !important;
}
.fotorama__wrap .fotorama__grab {
  cursor: grab;
}
.fotorama__grabbing * {
  cursor: grabbing;
}
.fotorama__img,
.fotorama__spinner {
  position: absolute !important;
  top: 50% !important;
  left: 50% !important;
}
.fotorama__img {
  margin: -50% 0 0 -50%;
  width: 100%;
  height: 100%;
}
.fotorama__wrap--css3 .fotorama__arr,
.fotorama__wrap--css3 .fotorama__fullscreen-icon,
.fotorama__wrap--css3 .fotorama__nav__shaft,
.fotorama__wrap--css3 .fotorama__stage__shaft,
.fotorama__wrap--css3 .fotorama__thumb-border,
.fotorama__wrap--css3 .fotorama__video-close,
.fotorama__wrap--css3 .fotorama__video-play {
  -webkit-transform: translate3d(0, 0, 0);
  -webkit-transform: translate3d(0, 0, 0);
  -moz-transform: translate3d(0, 0, 0);
  -o-transform: translate3d(0, 0, 0);
  -ms-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
}
.fotorama__caption,
.fotorama__nav:after,
.fotorama__nav:before,
.fotorama__stage:after,
.fotorama__stage:before,
.fotorama__wrap--css3 .fotorama__html,
.fotorama__wrap--css3 .fotorama__nav,
.fotorama__wrap--css3 .fotorama__spinner,
.fotorama__wrap--css3 .fotorama__stage,
.fotorama__wrap--css3 .fotorama__stage .fotorama__img,
.fotorama__wrap--css3 .fotorama__stage__frame {
  -webkit-transform: translateZ(0);
  -webkit-transform: translateZ(0);
  -moz-transform: translateZ(0);
  -o-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
}
.fotorama__wrap--video .fotorama__stage,
.fotorama__wrap--video .fotorama__stage__frame--video,
.fotorama__wrap--video .fotorama__stage__frame--video .fotorama__html,
.fotorama__wrap--video .fotorama__stage__frame--video .fotorama__img,
.fotorama__wrap--video .fotorama__stage__shaft {
  -webkit-transform: none !important;
  -webkit-transform: none !important;
  -moz-transform: none !important;
  -o-transform: none !important;
  -ms-transform: none !important;
  transform: none !important;
}
.fotorama__wrap--css3 .fotorama__nav__shaft,
.fotorama__wrap--css3 .fotorama__stage__shaft,
.fotorama__wrap--css3 .fotorama__thumb-border {
  -webkit-transition-property: -webkit-transform;
  -webkit-transition-property: -webkit-transform;
  -moz-transition-property: -moz-transform;
  -o-transition-property: -o-transform;
  -ms-transition-property: -ms-transform;
  transition-property: transform;
  -webkit-transition-timing-function: cubic-bezier(0.1, 0, 0.25, 1);
  -webkit-transition-timing-function: cubic-bezier(0.1, 0, 0.25, 1);
  -moz-transition-timing-function: cubic-bezier(0.1, 0, 0.25, 1);
  -o-transition-timing-function: cubic-bezier(0.1, 0, 0.25, 1);
  -ms-transition-timing-function: cubic-bezier(0.1, 0, 0.25, 1);
  transition-timing-function: cubic-bezier(0.1, 0, 0.25, 1);
  -webkit-transition-duration: 0ms;
  -webkit-transition-duration: 0ms;
  -moz-transition-duration: 0ms;
  -o-transition-duration: 0ms;
  -ms-transition-duration: 0ms;
  transition-duration: 0ms;
}
.fotorama__arr,
.fotorama__fullscreen-icon,
.fotorama__no-select,
.fotorama__video-close,
.fotorama__video-play,
.fotorama__wrap {
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
.fotorama__select {
  -webkit-user-select: text;
  -moz-user-select: text;
  -ms-user-select: text;
  -webkit-user-select: text;
  -moz-user-select: text;
  -ms-user-select: text;
  user-select: text;
}
.fotorama__nav,
.fotorama__nav__frame {
  margin: 0;
  padding: 0;
}
.fotorama__caption__wrap,
.fotorama__nav__frame,
.fotorama__nav__shaft {
  -moz-box-orient: vertical;
  display: inline-block;
  vertical-align: middle;
  *display: inline;
  *zoom: 1;
}
.fotorama__wrap * {
  -moz-box-sizing: content-box;
  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
}
.fotorama__caption__wrap {
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
.fotorama--hidden,
.fotorama__load {
  position: absolute;
  left: -99999px;
  top: -99999px;
  z-index: -1;
}
.fotorama__arr,
.fotorama__fullscreen-icon,
.fotorama__nav,
.fotorama__nav__frame,
.fotorama__nav__shaft,
.fotorama__stage__frame,
.fotorama__stage__shaft,
.fotorama__video-close,
.fotorama__video-play {
  -webkit-tap-highlight-color: rgba(0,0,0,0);
}
.fotorama__arr:before,
.fotorama__fullscreen-icon:before,
.fotorama__video-close:before,
.fotorama__video-play:before {
  font-family: 'FontAwesome';
}
.fotorama__thumb {
  background-color: rgba(127,127,127,0.2);
}
.fotorama {
  min-width: 1px;
  overflow: hidden;
}
.fotorama:not(.fotorama--unobtrusive)>:not(:first-child) {
  display: none;
}
.fullscreen {
  width: 100% !important;
  height: 100% !important;
  max-width: 100% !important;
  max-height: 100% !important;
  margin: 0 !important;
  padding: 0 !important;
  overflow: hidden !important;
  background: #000;
}
.fotorama--fullscreen {
  position: absolute !important;
  top: 0 !important;
  left: 0 !important;
  right: 0 !important;
  bottom: 0 !important;
  float: none !important;
  z-index: 2147483647 !important;
  background: #000;
  width: 100% !important;
  height: 100% !important;
  margin: 0 !important;
}
.fotorama--fullscreen .fotorama__nav,
.fotorama--fullscreen .fotorama__stage {
  background: #000;
}
.fotorama__wrap {
  -webkit-text-size-adjust: 100%;
  position: relative;
  direction: ltr;
}
.fotorama__wrap--rtl .fotorama__stage__frame {
  direction: rtl;
}
.fotorama__nav,
.fotorama__stage {
  overflow: hidden;
  position: relative;
  max-width: 100%;
}
.fotorama__wrap--pan-y {
  -ms-touch-action: pan-y;
}
.fotorama__wrap .fotorama__pointer {
  cursor: pointer;
}
.fotorama__wrap--slide .fotorama__stage__frame {
  opacity: 1 !important;
  -ms-filter: none;
  filter: none;
}
.fotorama__stage__frame {
  overflow: hidden;
}
.fotorama__stage__frame.fotorama__active {
  z-index: 8;
}
.fotorama__wrap--fade .fotorama__stage__frame {
  display: none;
}
.fotorama__wrap--fade .fotorama__fade-front,
.fotorama__wrap--fade .fotorama__fade-rear,
.fotorama__wrap--fade .fotorama__stage__frame.fotorama__active {
  display: block;
  left: 0;
  top: 0;
}
.fotorama__wrap--fade .fotorama__fade-front {
  z-index: 8;
}
.fotorama__wrap--fade .fotorama__fade-rear {
  z-index: 7;
}
.fotorama__wrap--fade .fotorama__fade-rear.fotorama__active {
  z-index: 9;
}
.fotorama__wrap--fade .fotorama__stage .fotorama__shadow {
  display: none;
}
.fotorama__img {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  border: none !important;
}
.fotorama__error .fotorama__img,
.fotorama__loaded .fotorama__img {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.fotorama--fullscreen .fotorama__loaded--full .fotorama__img,
.fotorama__img--full {
  display: none;
}
.fotorama--fullscreen .fotorama__loaded--full .fotorama__img--full {
  display: block;
}
.fotorama__wrap--only-active .fotorama__nav,
.fotorama__wrap--only-active .fotorama__stage {
  max-width: 99999px !important;
}
.fotorama__wrap--only-active .fotorama__stage__frame {
  visibility: hidden;
}
.fotorama__wrap--only-active .fotorama__stage__frame.fotorama__active {
  visibility: visible;
}
.fotorama__nav {
  font-size: 0;
  line-height: 0;
  text-align: center;
  display: none;
  white-space: nowrap;
  z-index: 5;
}
.fotorama__nav__shaft {
  position: relative;
  left: 0;
  top: 0;
  text-align: left;
}
.fotorama__nav__frame {
  position: relative;
  cursor: pointer;
}
.fotorama__nav--dots {
  display: block;
  position: absolute;
  bottom: 0;
}
.fotorama__nav--dots .fotorama__nav__frame {
  width: 18px;
  height: 30px;
}
.fotorama__nav--dots .fotorama__nav__frame--thumb,
.fotorama__nav--dots .fotorama__thumb-border {
  display: none;
}
.fotorama__nav--thumbs {
  display: block;
}
.fotorama__nav--thumbs .fotorama__nav__frame {
  padding-left: 0 !important;
}
.fotorama__nav--thumbs .fotorama__nav__frame:last-child {
  padding-right: 0 !important;
}
.fotorama__nav--thumbs .fotorama__nav__frame--dot {
  display: none;
}
.fotorama__dot {
  display: block;
  width: 6px;
  height: 6px;
  position: relative;
  top: 12px;
  left: 6px;
  -webkit-border-radius: 6px;
  border-radius: 6px;
  background: #fff;
  opacity: 0.5;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
  filter: alpha(opacity=50);
}
.fotorama__nav__frame.fotorama__active {
  pointer-events: none;
  cursor: default;
}
.fotorama__nav__frame.fotorama__active .fotorama__dot {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.fotorama__active .fotorama__dot {
  background-color: #fff;
}
.fotorama__thumb {
  overflow: hidden;
  position: relative;
  width: 100%;
  height: 100%;
}
.fotorama__thumb-border {
  position: absolute;
  z-index: 9;
  top: 0;
  left: 0;
  border-style: solid;
  border-color: <?php echo $themecolor;?>;
}
.fotorama__caption {
  position: absolute;
  z-index: 12;
  bottom: 0;
  left: 0;
  right: 0;
  font-size: 14px;
  line-height: 1.5;
  color: #000;
}
.fotorama__caption a {
  text-decoration: none;
  color: #000;
  border-bottom: 1px solid;
  border-color: rgba(0,0,0,0.5);
}
.fotorama__caption a:hover {
  color: #333;
  border-color: rgba(51,51,51,0.5);
}
.fotorama__wrap--rtl .fotorama__caption {
  left: auto;
  right: 0;
}
.fotorama__wrap--no-captions .fotorama__caption,
.fotorama__wrap--video .fotorama__caption {
  display: none;
}
.fotorama__caption__wrap {
  background-color: rgba(255,255,255,0.9);
  padding: 5px 10px;
}
.fotorama__wrap--css3 .fotorama__spinner {
  -webkit-animation: spinner 24s infinite linear;
  -webkit-animation: spinner 24s infinite linear;
  -moz-animation: spinner 24s infinite linear;
  -o-animation: spinner 24s infinite linear;
  -ms-animation: spinner 24s infinite linear;
  animation: spinner 24s infinite linear;
}
.fotorama__wrap--css3 .fotorama__html,
.fotorama__wrap--css3 .fotorama__stage .fotorama__img {
  -webkit-transition-property: opacity;
  -moz-transition-property: opacity;
  -o-transition-property: opacity;
  -ms-transition-property: opacity;
  transition-property: opacity;
  -webkit-transition-timing-function: linear;
  -moz-transition-timing-function: linear;
  -o-transition-timing-function: linear;
  -ms-transition-timing-function: linear;
  transition-timing-function: linear;
  -webkit-transition-duration: 0.3s;
  -moz-transition-duration: 0.3s;
  -o-transition-duration: 0.3s;
  -ms-transition-duration: 0.3s;
  transition-duration: 0.3s;
}
.fotorama__wrap--video .fotorama__stage__frame--video .fotorama__html,
.fotorama__wrap--video .fotorama__stage__frame--video .fotorama__img {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.fotorama__select {
  cursor: auto;
}
.fotorama__video {
  top: 32px;
  right: 0;
  bottom: 0;
  left: 0;
  position: absolute;
  z-index: 10;
}
.fotorama__arr,
.fotorama__fullscreen-icon,
.fotorama__video-close,
.fotorama__video-play {
  position: absolute;
  z-index: 11;
  cursor: pointer;
}
.fotorama__arr {
  text-align: center;
  display: block;
  position: absolute;
  width: 32px;
  height: 32px;
  line-height: 32px;
  -webkit-border-radius: 50%;
  border-radius: 50%;
  top: 50%;
  margin: -16px 10px 0 10px;
  background: rgba(0,0,0,0.4);
  color: #fff;
  font-size: 20px;
}
.fotorama__arr:hover {
  background: rgba(0,0,0,0.6);
}
.fotorama__arr--prev {
  left: 0;
}
.fotorama__arr--prev:before {
  content: '\f104';
}
.fotorama__arr--next {
  right: 0;
}
.fotorama__arr--next:before {
  content: '\f105';
}
.fotorama__arr--disabled {
  pointer-events: none;
  cursor: default;
  *display: none;
  opacity: 0.3;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=30)";
  filter: alpha(opacity=30);
}
.fotorama__fullscreen-icon {
  width: 32px;
  height: 32px;
  line-height: 32px;
  top: 0;
  right: 0;
  z-index: 20;
  color: #fff;
  opacity: 0.8;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
  filter: alpha(opacity=80);
  -webkit-border-radius: 50%;
  border-radius: 50%;
  background: rgba(0,0,0,0.2);
  text-align: center;
  margin: 10px;
}
.fotorama__fullscreen-icon:hover {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.fotorama__fullscreen-icon:before {
  content: '\f065';
}
.fotorama--fullscreen .fotorama__fullscreen-icon:before {
  content: '\f066';
}
.fotorama__video-play {
  width: 96px;
  height: 96px;
  left: 50%;
  top: 50%;
  margin-left: -48px;
  margin-top: -48px;
  background-position: 0 -64px;
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.fotorama__wrap--css2 .fotorama__video-play,
.fotorama__wrap--video .fotorama__stage .fotorama__video-play {
  display: none;
}
.fotorama__error .fotorama__video-play,
.fotorama__loaded .fotorama__video-play {
  opacity: 1;
  -ms-filter: none;
  filter: none;
  display: block;
}
.fotorama__nav__frame .fotorama__video-play {
  width: 32px;
  height: 32px;
  margin-left: -16px;
  margin-top: -16px;
  background-position: -64px -32px;
}
.fotorama__video-close {
  width: 32px;
  height: 32px;
  top: 0;
  right: 0;
  background-position: -64px 0;
  z-index: 20;
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.fotorama__wrap--css2 .fotorama__video-close {
  display: none;
}
.fotorama__wrap--css3 .fotorama__video-close {
  -webkit-transform: translate3d(32px, -32px, 0);
  -moz-transform: translate3d(32px, -32px, 0);
  -o-transform: translate3d(32px, -32px, 0);
  -ms-transform: translate3d(32px, -32px, 0);
  transform: translate3d(32px, -32px, 0);
}
.fotorama__wrap--video .fotorama__video-close {
  display: block;
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.fotorama__wrap--css3.fotorama__wrap--video .fotorama__video-close {
  -webkit-transform: translate3d(0, 0, 0);
  -moz-transform: translate3d(0, 0, 0);
  -o-transform: translate3d(0, 0, 0);
  -ms-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
}
.fotorama__wrap--no-controls.fotorama__wrap--toggle-arrows .fotorama__arr,
.fotorama__wrap--no-controls.fotorama__wrap--toggle-arrows .fotorama__fullscreen-icon,
.fotorama__wrap--video .fotorama__arr,
.fotorama__wrap--video .fotorama__fullscreen-icon {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.fotorama__wrap--css2.fotorama__wrap--no-controls .fotorama__arr,
.fotorama__wrap--css2.fotorama__wrap--no-controls .fotorama__fullscreen-icon,
.fotorama__wrap--css2.fotorama__wrap--video .fotorama__arr,
.fotorama__wrap--css2.fotorama__wrap--video .fotorama__fullscreen-icon {
  display: none;
}
.fotorama__wrap--css3.fotorama__wrap--no-controls.fotorama__wrap--slide.fotorama__wrap--toggle-arrows .fotorama__fullscreen-icon,
.fotorama__wrap--css3.fotorama__wrap--video .fotorama__fullscreen-icon {
  -webkit-transform: translate3d(32px, -32px, 0);
  -moz-transform: translate3d(32px, -32px, 0);
  -o-transform: translate3d(32px, -32px, 0);
  -ms-transform: translate3d(32px, -32px, 0);
  transform: translate3d(32px, -32px, 0);
}
.fotorama__wrap--css3.fotorama__wrap--no-controls.fotorama__wrap--slide.fotorama__wrap--toggle-arrows .fotorama__arr--prev,
.fotorama__wrap--css3.fotorama__wrap--video .fotorama__arr--prev {
  -webkit-transform: translate3d(-48px, 0, 0);
  -moz-transform: translate3d(-48px, 0, 0);
  -o-transform: translate3d(-48px, 0, 0);
  -ms-transform: translate3d(-48px, 0, 0);
  transform: translate3d(-48px, 0, 0);
}
.fotorama__wrap--css3.fotorama__wrap--no-controls.fotorama__wrap--slide.fotorama__wrap--toggle-arrows .fotorama__arr--next,
.fotorama__wrap--css3.fotorama__wrap--video .fotorama__arr--next {
  -webkit-transform: translate3d(48px, 0, 0);
  -moz-transform: translate3d(48px, 0, 0);
  -o-transform: translate3d(48px, 0, 0);
  -ms-transform: translate3d(48px, 0, 0);
  transform: translate3d(48px, 0, 0);
}
.fotorama__wrap--css3 .fotorama__arr,
.fotorama__wrap--css3 .fotorama__fullscreen-icon,
.fotorama__wrap--css3 .fotorama__video-close,
.fotorama__wrap--css3 .fotorama__video-play {
  -webkit-transition-property: -webkit-transform, opacity;
  -moz-transition-property: -moz-transform, opacity;
  -o-transition-property: -o-transform, opacity;
  -ms-transition-property: -ms-transform, opacity;
  transition-property: transform, opacity;
  -webkit-transition-duration: 0.3s;
  -moz-transition-duration: 0.3s;
  -o-transition-duration: 0.3s;
  -ms-transition-duration: 0.3s;
  transition-duration: 0.3s;
}
.fotorama__nav:after,
.fotorama__nav:before,
.fotorama__stage:after,
.fotorama__stage:before {
  content: "";
  display: block;
  position: absolute;
  text-decoration: none;
  top: 0;
  bottom: 0;
  width: 10px;
  height: auto;
  z-index: 10;
  pointer-events: none;
  background-repeat: no-repeat;
  -webkit-background-size: 1px 100%, 5px 100%;
  -moz-background-size: 1px 100%, 5px 100%;
  background-size: 1px 100%, 5px 100%;
}
.fotorama__nav:before,
.fotorama__stage:before {
  background-position: 0 0, 0 0;
  left: -10px;
}
.fotorama__nav.fotorama__shadows--left:before,
.fotorama__stage.fotorama__shadows--left:before {
  left: 0;
}
.fotorama__nav:after,
.fotorama__stage:after {
  background-position: 100% 0, 100% 0;
  right: -10px;
}
.fotorama__nav.fotorama__shadows--right:after,
.fotorama__stage.fotorama__shadows--right:after {
  right: 0;
}
.fotorama--fullscreen .fotorama__nav:after,
.fotorama--fullscreen .fotorama__nav:before,
.fotorama--fullscreen .fotorama__stage:after,
.fotorama--fullscreen .fotorama__stage:before,
.fotorama__wrap--fade .fotorama__stage:after,
.fotorama__wrap--fade .fotorama__stage:before,
.fotorama__wrap--no-shadows .fotorama__nav:after,
.fotorama__wrap--no-shadows .fotorama__nav:before,
.fotorama__wrap--no-shadows .fotorama__stage:after,
.fotorama__wrap--no-shadows .fotorama__stage:before {
  display: none;
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0);
    -moz-transform: rotate(0);
    -o-transform: rotate(0);
    -ms-transform: rotate(0);
    transform: rotate(0);
  }

  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0);
    -moz-transform: rotate(0);
    -o-transform: rotate(0);
    -ms-transform: rotate(0);
    transform: rotate(0);
  }

  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0);
    -moz-transform: rotate(0);
    -o-transform: rotate(0);
    -ms-transform: rotate(0);
    transform: rotate(0);
  }

  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-ms-keyframes spinner {
  0% {
    -webkit-transform: rotate(0);
    -moz-transform: rotate(0);
    -o-transform: rotate(0);
    -ms-transform: rotate(0);
    transform: rotate(0);
  }

  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0);
    -moz-transform: rotate(0);
    -o-transform: rotate(0);
    -ms-transform: rotate(0);
    transform: rotate(0);
  }

  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
.tt-hint {
  color: #999;
}
.tt-dropdown-menu {
  width: 100%;
  margin-top: 7px;
  background: #fff;
  border: 1px solid #e6e6e6;
  max-height: 300px;
  overflow-y: auto;
  white-space: nowrap;
}
.tt-suggestion {
  line-height: 1em;
  padding: 15px 20px;
  font-size: 13px;
  border-bottom: 1px solid #e6e6e6;
}
.tt-suggestion p {
  margin: 0;
}
.tt-suggestion.tt-cursor {
  color: #fff;
  background: <?php echo $themecolor;?>;
  cursor: pointer;
}
.owl-carousel .owl-wrapper:after {
  content: '.';
  display: block;
  clear: both;
  visibility: hidden;
  line-height: 0;
  height: 0;
}
.owl-carousel {
  display: none;
  position: relative;
  -ms-touch-action: pan-y;
  margin: 0 -15px;
  padding: 0 45px;
}
.owl-carousel[data-nav="false"] {
  padding: 0 !important;
}
.owl-carousel[data-nav="false"] .owl-buttons {
  display: none !important;
}
.owl-carousel[data-pagination="false"] .owl-pagination {
  display: none !important;
}
.owl-carousel.owl-slider {
  margin: 0;
  padding: 0;
}
.owl-carousel.owl-slider .owl-controls .owl-buttons div.owl-next {
  right: 30px;
}
.owl-carousel.owl-slider .owl-controls .owl-buttons div.owl-prev {
  left: 30px;
}
.owl-carousel.owl-slider[data-nav="top-right"] .owl-buttons div {
  top: 20px;
  margin: 0;
  width: 25px;
  height: 25px;
  line-height: 25px;
  font-size: 15px;
}
.owl-carousel.owl-slider[data-nav="top-right"] .owl-buttons div.owl-next {
  right: 15px;
}
.owl-carousel.owl-slider[data-nav="top-right"] .owl-buttons div.owl-prev {
  left: auto;
  right: 50px;
}
.owl-carousel.owl-slider .owl-item {
  padding: 0;
}
.owl-carousel .owl-wrapper {
  display: none;
  position: relative;
  -webkit-transform: translate3d(0, 0, 0);
  -moz-transform: translate3d(0, 0, 0);
  -o-transform: translate3d(0, 0, 0);
  -ms-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
}
.owl-carousel .owl-wrapper-outer {
  overflow: hidden;
  position: relative;
  width: 100%;
}
.owl-carousel .owl-wrapper-outer.autoHeight {
  -webkit-transition: height 500ms ease-in-out;
  -moz-transition: height 500ms ease-in-out;
  -o-transition: height 500ms ease-in-out;
  -ms-transition: height 500ms ease-in-out;
  transition: height 500ms ease-in-out;
}
.owl-carousel .owl-item {
  float: left;
  padding: 0 15px;
}
.owl-carousel .owl-item.loading {
  min-height: 150px;
  background: url("AjaxLoader.gif") no-repeat center center;
}
.owl-carousel .owl-item .owl-caption {
  position: absolute;
  z-index: 99;
  background: rgba(0,0,0,0.5);
  padding: 10px 15px;
  color: #fff;
  width: 50%;
}
.top-area .owl-carousel-area .owl-item {
  height: 700px;
}
.special-area .owl-carousel-area .owl-item {
  height: 500px;
}
[data-inner-pagination="true"] .owl-controls .owl-pagination {
  margin: 0;
  position: absolute;
  bottom: 30px;
  width: 100%;
}
[data-white-pagination="true"] .owl-controls .owl-pagination .owl-page span {
  background: #fff;
}
.owl-controls {
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  -webkit-tap-highlight-color: rgba(0,0,0,0.01);
  text-align: center;
}
.owl-controls .owl-pagination {
  margin-top: 10px;
}
.owl-controls .owl-page,
.owl-controls .owl-buttons div {
  cursor: pointer;
  color: #fff;
  display: inline-block;
  zoom: 1;
  *display: inline;
  margin: 5px;
  -webkit-border-radius: 50%;
  border-radius: 50%;
}
.owl-controls .owl-page:hover,
.owl-controls .owl-buttons div:hover {
  opacity: 1;
  -ms-filter: none;
  filter: none;
  text-decoration: none;
}
.owl-controls .owl-page {
  display: inline-block;
  zoom: 1;
  *display: inline;
}
.owl-controls .owl-page span {
  display: block;
  width: 12px;
  height: 12px;
  opacity: 0.5;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
  filter: alpha(opacity=50);
  -webkit-border-radius: 50%;
  border-radius: 50%;
  background: <?php echo $themecolor;?>;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
.owl-controls .owl-page.active span {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.owl-controls.clickable .owl-page:hover span {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.owl-controls span.owl-numbers {
  height: auto;
  width: auto;
  color: #fff;
  padding: 2px 10px;
  font-size: 12px;
  -webkit-border-radius: 30px;
  border-radius: 30px;
}
.owl-controls .owl-buttons div {
  position: absolute;
  top: 50%;
  width: 30px;
  height: 30px;
  line-height: 30px;
  display: block;
  -webkit-box-shadow: 0 0 0 1px #fff;
  box-shadow: 0 0 0 1px #fff;
  margin: -30px 0 0 0;
  background: rgba(0,0,0,0.2);
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
  font-size: 17px;
}
.owl-controls .owl-buttons div:hover {
  background: <?php echo $themecolor;?>;
  -webkit-box-shadow: 0 0 0 1px <?php echo $themecolor;?>;
  box-shadow: 0 0 0 1px <?php echo $themecolor;?>;
}
.owl-controls .owl-buttons div:before {
  font-family: 'FontAwesome';
}
.owl-controls .owl-buttons div.owl-next {
  right: 0;
}
.owl-controls .owl-buttons div.owl-next:before {
  content: '\f105';
}
.owl-controls .owl-buttons div.owl-prev {
  left: 0;
}
.owl-controls .owl-buttons div.owl-prev:before {
  content: '\f104';
}
.grabbing {
  cursor: url("../img/grabbing.png") 8 8, move;
}
.owl-carousel .owl-wrapper,
.owl-carousel .owl-item {
  -webkit-backface-visibility: hidden;
  -moz-backface-visibility: hidden;
  -ms-backface-visibility: hidden;
  backface-visibility: hidden;
  -webkit-transform: translate3d(0, 0, 0);
  -moz-transform: translate3d(0, 0, 0);
  -o-transform: translate3d(0, 0, 0);
  -ms-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
}
.owl-origin {
  -webkit-perspective: 1200px;
  -moz-perspective: 1200px;
  -ms-perspective: 1200px;
  perspective: 1200px;
  perspective-x: 50%;
  perspective-y: 50%;
}
.owl-fade-out {
  z-index: 10;
  -webkit-animation: fadeOut 0.7s both ease;
  -moz-animation: fadeOut 0.7s both ease;
  -o-animation: fadeOut 0.7s both ease;
  -ms-animation: fadeOut 0.7s both ease;
  animation: fadeOut 0.7s both ease;
}
.owl-fade-in {
  -webkit-animation: fadeIn 0.7s both ease;
  -moz-animation: fadeIn 0.7s both ease;
  -o-animation: fadeIn 0.7s both ease;
  -ms-animation: fadeIn 0.7s both ease;
  animation: fadeIn 0.7s both ease;
}
.owl-backSlide-out {
  -webkit-animation: backSlideOut 1s both ease;
  -moz-animation: backSlideOut 1s both ease;
  -o-animation: backSlideOut 1s both ease;
  -ms-animation: backSlideOut 1s both ease;
  animation: backSlideOut 1s both ease;
}
.owl-backSlide-in {
  -webkit-animation: backSlideIn 1s both ease;
  -moz-animation: backSlideIn 1s both ease;
  -o-animation: backSlideIn 1s both ease;
  -ms-animation: backSlideIn 1s both ease;
  animation: backSlideIn 1s both ease;
}
.owl-goDown-out {
  -webkit-animation: scaleToFade 0.7s ease both;
  -moz-animation: scaleToFade 0.7s ease both;
  -o-animation: scaleToFade 0.7s ease both;
  -ms-animation: scaleToFade 0.7s ease both;
  animation: scaleToFade 0.7s ease both;
}
.owl-goDown-in {
  -webkit-animation: goDown 0.6s ease both;
  -moz-animation: goDown 0.6s ease both;
  -o-animation: goDown 0.6s ease both;
  -ms-animation: goDown 0.6s ease both;
  animation: goDown 0.6s ease both;
}
.owl-fadeUp-in {
  -webkit-animation: scaleUpFrom 0.5s ease both;
  -moz-animation: scaleUpFrom 0.5s ease both;
  -o-animation: scaleUpFrom 0.5s ease both;
  -ms-animation: scaleUpFrom 0.5s ease both;
  animation: scaleUpFrom 0.5s ease both;
}
.owl-fadeUp-out {
  -webkit-animation: scaleUpTo 0.5s ease both;
  -moz-animation: scaleUpTo 0.5s ease both;
  -o-animation: scaleUpTo 0.5s ease both;
  -ms-animation: scaleUpTo 0.5s ease both;
  animation: scaleUpTo 0.5s ease both;
}
.owl-cap-title {
  line-height: 1em;
  font-size: 120px;
  display: table;
  margin: 10px auto;
  padding: 10px 0;
  border-bottom: 1px solid rgba(255,255,255,0.2);
  border-top: 1px solid rgba(255,255,255,0.2);
  text-transform: uppercase;
}
@media (max-width:992px) {
  .owl-cap-title {
    font-size: 60px;
  }
}
.owl-cap-price {
  margin-bottom: 15px;
}
.owl-cap-price small {
  font-size: 20px;
  opacity: 0.8;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
  filter: alpha(opacity=80);
  display: block;
}
.owl-cap-price h5 {
  font-size: 50px;
  color: #ef8f39;
  line-height: 1em;
  margin: 0;
}
.owl-cap-weather {
  opacity: 0.8;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
  filter: alpha(opacity=80);
}
.owl-cap-weather .im {
  font-size: 60px;
}
.owl-cap-weather span {
  font-size: 25px;
  position: relative;
  top: -10px;
  margin-right: 15px;
}
.owl-cap-weather span:after {
  content: '';
  height: 7px;
  width: 7px;
  position: absolute;
  top: 3px;
  right: -7px;
  border: 2px solid #fff;
  -webkit-border-radius: 50%;
  border-radius: 50%;
}
@-moz-keyframes empty {
  0% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-webkit-keyframes empty {
  0% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-o-keyframes empty {
  0% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-ms-keyframes empty {
  0% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@keyframes empty {
  0% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-moz-keyframes fadeIn {
  0% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }

  100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-webkit-keyframes fadeIn {
  0% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }

  100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-o-keyframes fadeIn {
  0% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }

  100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-ms-keyframes fadeIn {
  0% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }

  100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@keyframes fadeIn {
  0% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }

  100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-moz-keyframes fadeOut {
  0% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }

  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }
}
@-webkit-keyframes fadeOut {
  0% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }

  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }
}
@-o-keyframes fadeOut {
  0% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }

  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }
}
@-ms-keyframes fadeOut {
  0% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }

  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }
}
@keyframes fadeOut {
  0% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }

  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }
}
@-moz-keyframes backSlideOut {
  25% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px);
    -moz-transform: translateZ(-500px);
    -o-transform: translateZ(-500px);
    -ms-transform: translateZ(-500px);
    transform: translateZ(-500px);
  }

  75% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(-200%);
    -moz-transform: translateZ(-500px) translateX(-200%);
    -o-transform: translateZ(-500px) translateX(-200%);
    -ms-transform: translateZ(-500px) translateX(-200%);
    transform: translateZ(-500px) translateX(-200%);
  }

  100% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(-200%);
    -moz-transform: translateZ(-500px) translateX(-200%);
    -o-transform: translateZ(-500px) translateX(-200%);
    -ms-transform: translateZ(-500px) translateX(-200%);
    transform: translateZ(-500px) translateX(-200%);
  }
}
@-webkit-keyframes backSlideOut {
  25% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px);
    -moz-transform: translateZ(-500px);
    -o-transform: translateZ(-500px);
    -ms-transform: translateZ(-500px);
    transform: translateZ(-500px);
  }

  75% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(-200%);
    -moz-transform: translateZ(-500px) translateX(-200%);
    -o-transform: translateZ(-500px) translateX(-200%);
    -ms-transform: translateZ(-500px) translateX(-200%);
    transform: translateZ(-500px) translateX(-200%);
  }

  100% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(-200%);
    -moz-transform: translateZ(-500px) translateX(-200%);
    -o-transform: translateZ(-500px) translateX(-200%);
    -ms-transform: translateZ(-500px) translateX(-200%);
    transform: translateZ(-500px) translateX(-200%);
  }
}
@-o-keyframes backSlideOut {
  25% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px);
    -moz-transform: translateZ(-500px);
    -o-transform: translateZ(-500px);
    -ms-transform: translateZ(-500px);
    transform: translateZ(-500px);
  }

  75% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(-200%);
    -moz-transform: translateZ(-500px) translateX(-200%);
    -o-transform: translateZ(-500px) translateX(-200%);
    -ms-transform: translateZ(-500px) translateX(-200%);
    transform: translateZ(-500px) translateX(-200%);
  }

  100% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(-200%);
    -moz-transform: translateZ(-500px) translateX(-200%);
    -o-transform: translateZ(-500px) translateX(-200%);
    -ms-transform: translateZ(-500px) translateX(-200%);
    transform: translateZ(-500px) translateX(-200%);
  }
}
@-ms-keyframes backSlideOut {
  25% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px);
    -moz-transform: translateZ(-500px);
    -o-transform: translateZ(-500px);
    -ms-transform: translateZ(-500px);
    transform: translateZ(-500px);
  }

  75% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(-200%);
    -moz-transform: translateZ(-500px) translateX(-200%);
    -o-transform: translateZ(-500px) translateX(-200%);
    -ms-transform: translateZ(-500px) translateX(-200%);
    transform: translateZ(-500px) translateX(-200%);
  }

  100% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(-200%);
    -moz-transform: translateZ(-500px) translateX(-200%);
    -o-transform: translateZ(-500px) translateX(-200%);
    -ms-transform: translateZ(-500px) translateX(-200%);
    transform: translateZ(-500px) translateX(-200%);
  }
}
@keyframes backSlideOut {
  25% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px);
    -moz-transform: translateZ(-500px);
    -o-transform: translateZ(-500px);
    -ms-transform: translateZ(-500px);
    transform: translateZ(-500px);
  }

  75% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(-200%);
    -moz-transform: translateZ(-500px) translateX(-200%);
    -o-transform: translateZ(-500px) translateX(-200%);
    -ms-transform: translateZ(-500px) translateX(-200%);
    transform: translateZ(-500px) translateX(-200%);
  }

  100% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(-200%);
    -moz-transform: translateZ(-500px) translateX(-200%);
    -o-transform: translateZ(-500px) translateX(-200%);
    -ms-transform: translateZ(-500px) translateX(-200%);
    transform: translateZ(-500px) translateX(-200%);
  }
}
@-moz-keyframes backSlideIn {
  0%, 25% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(200%);
    -moz-transform: translateZ(-500px) translateX(200%);
    -o-transform: translateZ(-500px) translateX(200%);
    -ms-transform: translateZ(-500px) translateX(200%);
    transform: translateZ(-500px) translateX(200%);
  }

  75% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px);
    -moz-transform: translateZ(-500px);
    -o-transform: translateZ(-500px);
    -ms-transform: translateZ(-500px);
    transform: translateZ(-500px);
  }

  100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
    -webkit-transform: translateZ(0) translateX(0);
    -moz-transform: translateZ(0) translateX(0);
    -o-transform: translateZ(0) translateX(0);
    -ms-transform: translateZ(0) translateX(0);
    transform: translateZ(0) translateX(0);
  }
}
@-webkit-keyframes backSlideIn {
  0%, 25% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(200%);
    -moz-transform: translateZ(-500px) translateX(200%);
    -o-transform: translateZ(-500px) translateX(200%);
    -ms-transform: translateZ(-500px) translateX(200%);
    transform: translateZ(-500px) translateX(200%);
  }

  75% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px);
    -moz-transform: translateZ(-500px);
    -o-transform: translateZ(-500px);
    -ms-transform: translateZ(-500px);
    transform: translateZ(-500px);
  }

  100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
    -webkit-transform: translateZ(0) translateX(0);
    -moz-transform: translateZ(0) translateX(0);
    -o-transform: translateZ(0) translateX(0);
    -ms-transform: translateZ(0) translateX(0);
    transform: translateZ(0) translateX(0);
  }
}
@-o-keyframes backSlideIn {
  0%, 25% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(200%);
    -moz-transform: translateZ(-500px) translateX(200%);
    -o-transform: translateZ(-500px) translateX(200%);
    -ms-transform: translateZ(-500px) translateX(200%);
    transform: translateZ(-500px) translateX(200%);
  }

  75% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px);
    -moz-transform: translateZ(-500px);
    -o-transform: translateZ(-500px);
    -ms-transform: translateZ(-500px);
    transform: translateZ(-500px);
  }

  100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
    -webkit-transform: translateZ(0) translateX(0);
    -moz-transform: translateZ(0) translateX(0);
    -o-transform: translateZ(0) translateX(0);
    -ms-transform: translateZ(0) translateX(0);
    transform: translateZ(0) translateX(0);
  }
}
@-ms-keyframes backSlideIn {
  0%, 25% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(200%);
    -moz-transform: translateZ(-500px) translateX(200%);
    -o-transform: translateZ(-500px) translateX(200%);
    -ms-transform: translateZ(-500px) translateX(200%);
    transform: translateZ(-500px) translateX(200%);
  }

  75% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px);
    -moz-transform: translateZ(-500px);
    -o-transform: translateZ(-500px);
    -ms-transform: translateZ(-500px);
    transform: translateZ(-500px);
  }

  100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
    -webkit-transform: translateZ(0) translateX(0);
    -moz-transform: translateZ(0) translateX(0);
    -o-transform: translateZ(0) translateX(0);
    -ms-transform: translateZ(0) translateX(0);
    transform: translateZ(0) translateX(0);
  }
}
@keyframes backSlideIn {
  0%, 25% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(200%);
    -moz-transform: translateZ(-500px) translateX(200%);
    -o-transform: translateZ(-500px) translateX(200%);
    -ms-transform: translateZ(-500px) translateX(200%);
    transform: translateZ(-500px) translateX(200%);
  }

  75% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px);
    -moz-transform: translateZ(-500px);
    -o-transform: translateZ(-500px);
    -ms-transform: translateZ(-500px);
    transform: translateZ(-500px);
  }

  100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
    -webkit-transform: translateZ(0) translateX(0);
    -moz-transform: translateZ(0) translateX(0);
    -o-transform: translateZ(0) translateX(0);
    -ms-transform: translateZ(0) translateX(0);
    transform: translateZ(0) translateX(0);
  }
}
@-moz-keyframes scaleToFade {
  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(0.8);
    -moz-transform: scale(0.8);
    -o-transform: scale(0.8);
    -ms-transform: scale(0.8);
    transform: scale(0.8);
  }
}
@-webkit-keyframes scaleToFade {
  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(0.8);
    -moz-transform: scale(0.8);
    -o-transform: scale(0.8);
    -ms-transform: scale(0.8);
    transform: scale(0.8);
  }
}
@-o-keyframes scaleToFade {
  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(0.8);
    -moz-transform: scale(0.8);
    -o-transform: scale(0.8);
    -ms-transform: scale(0.8);
    transform: scale(0.8);
  }
}
@-ms-keyframes scaleToFade {
  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(0.8);
    -moz-transform: scale(0.8);
    -o-transform: scale(0.8);
    -ms-transform: scale(0.8);
    transform: scale(0.8);
  }
}
@keyframes scaleToFade {
  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(0.8);
    -moz-transform: scale(0.8);
    -o-transform: scale(0.8);
    -ms-transform: scale(0.8);
    transform: scale(0.8);
  }
}
@-moz-keyframes goDown {
  0% {
    -webkit-transform: translateY(-100%);
    -moz-transform: translateY(-100%);
    -o-transform: translateY(-100%);
    -ms-transform: translateY(-100%);
    transform: translateY(-100%);
  }
}
@-webkit-keyframes goDown {
  0% {
    -webkit-transform: translateY(-100%);
    -moz-transform: translateY(-100%);
    -o-transform: translateY(-100%);
    -ms-transform: translateY(-100%);
    transform: translateY(-100%);
  }
}
@-o-keyframes goDown {
  0% {
    -webkit-transform: translateY(-100%);
    -moz-transform: translateY(-100%);
    -o-transform: translateY(-100%);
    -ms-transform: translateY(-100%);
    transform: translateY(-100%);
  }
}
@-ms-keyframes goDown {
  0% {
    -webkit-transform: translateY(-100%);
    -moz-transform: translateY(-100%);
    -o-transform: translateY(-100%);
    -ms-transform: translateY(-100%);
    transform: translateY(-100%);
  }
}
@keyframes goDown {
  0% {
    -webkit-transform: translateY(-100%);
    -moz-transform: translateY(-100%);
    -o-transform: translateY(-100%);
    -ms-transform: translateY(-100%);
    transform: translateY(-100%);
  }
}
@-moz-keyframes scaleUpFrom {
  0% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(1.5);
    -moz-transform: scale(1.5);
    -o-transform: scale(1.5);
    -ms-transform: scale(1.5);
    transform: scale(1.5);
  }
}
@-webkit-keyframes scaleUpFrom {
  0% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(1.5);
    -moz-transform: scale(1.5);
    -o-transform: scale(1.5);
    -ms-transform: scale(1.5);
    transform: scale(1.5);
  }
}
@-o-keyframes scaleUpFrom {
  0% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(1.5);
    -moz-transform: scale(1.5);
    -o-transform: scale(1.5);
    -ms-transform: scale(1.5);
    transform: scale(1.5);
  }
}
@-ms-keyframes scaleUpFrom {
  0% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(1.5);
    -moz-transform: scale(1.5);
    -o-transform: scale(1.5);
    -ms-transform: scale(1.5);
    transform: scale(1.5);
  }
}
@keyframes scaleUpFrom {
  0% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(1.5);
    -moz-transform: scale(1.5);
    -o-transform: scale(1.5);
    -ms-transform: scale(1.5);
    transform: scale(1.5);
  }
}
@-moz-keyframes scaleUpTo {
  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(1.5);
    -moz-transform: scale(1.5);
    -o-transform: scale(1.5);
    -ms-transform: scale(1.5);
    transform: scale(1.5);
  }
}
@-webkit-keyframes scaleUpTo {
  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(1.5);
    -moz-transform: scale(1.5);
    -o-transform: scale(1.5);
    -ms-transform: scale(1.5);
    transform: scale(1.5);
  }
}
@-o-keyframes scaleUpTo {
  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(1.5);
    -moz-transform: scale(1.5);
    -o-transform: scale(1.5);
    -ms-transform: scale(1.5);
    transform: scale(1.5);
  }
}
@-ms-keyframes scaleUpTo {
  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(1.5);
    -moz-transform: scale(1.5);
    -o-transform: scale(1.5);
    -ms-transform: scale(1.5);
    transform: scale(1.5);
  }
}
@keyframes scaleUpTo {
  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(1.5);
    -moz-transform: scale(1.5);
    -o-transform: scale(1.5);
    -ms-transform: scale(1.5);
    transform: scale(1.5);
  }
}
.countdown {
  width: 400px;
  overflow: hidden;
  height: 58px;
  margin: 20px 0;
  display: table;
}
.countdown > div {
  display: table-cell;
}
.countdown > div > span {
  display: block;
  text-align: center;
}
span.count {
  font-size: 48px;
  line-height: 48px;
}
.countdown.countdown-inline {
  width: 100%;
  margin: 10px 0 0 0;
  height: auto;
}
.countdown.countdown-inline > div {
  display: inline;
}
.countdown.countdown-inline > div:first-child span.count {
  font-size: 25px;
  font-weight: bold;
  margin-right: 5px;
  color: <?php echo $themecolor;?>;
}
.countdown.countdown-inline > div:first-child span.title {
  font-size: 20px;
  font-weight: bold;
  display: inline;
  margin-right: 10px;
  color: <?php echo $themecolor;?>;
}
.countdown.countdown-inline > div:first-child span.count:after,
.countdown.countdown-inline > div:last-child span.count:after {
  content: '';
  margin: 0;
}
.countdown.countdown-inline > div > span {
  display: inline;
  line-height: 1em;
}
.countdown.countdown-inline > div span.count {
  font-size: 20px;
}
.countdown.countdown-inline > div span.count:after {
  content: ':';
  margin: 0 2px;
}
.countdown.countdown-inline > div span.title {
  display: none;
}
.countdown-lg {
  margin: 20px auto;
  padding: 15px 0;
  border-top: 1px solid rgba(255,255,255,0.15);
  border-bottom: 1px solid rgba(255,255,255,0.15);
}
.countdown-lg span.count {
  font-size: 70px;
  margin-bottom: 10px;
}
.countdown-lg > div {
  padding: 0 25px;
}
.countdown-lg .title {
  color: rgba(255,255,255,0.7);
}
.mfp-bg {
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1042;
  overflow: hidden;
  position: fixed;
  background: #0b0b0b;
  opacity: 0.8;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
  filter: alpha(opacity=80);
}
.mfp-wrap {
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1043;
  position: fixed;
  outline: none !important;
  -webkit-backface-visibility: hidden;
  -moz-backface-visibility: hidden;
  -ms-backface-visibility: hidden;
  backface-visibility: hidden;
}
.mfp-container {
  text-align: center;
  position: absolute;
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
  padding: 0 8px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
.mfp-container:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
}
.mfp-align-top .mfp-container:before {
  display: none;
}
.mfp-content {
  position: relative;
  display: inline-block;
  vertical-align: middle;
  margin: 0 auto;
  text-align: left;
  z-index: 1045;
}
.mfp-inline-holder .mfp-content,
.mfp-ajax-holder .mfp-content {
  width: 100%;
  cursor: auto;
}
.mfp-ajax-cur {
  cursor: progress;
}
.mfp-zoom-out-cur,
.mfp-zoom-out-cur .mfp-image-holder .mfp-close {
  cursor: zoom-out;
}
.mfp-zoom {
  cursor: zoom-in;
}
.mfp-auto-cursor .mfp-content {
  cursor: auto;
}
.mfp-counter {
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
.mfp-loading.mfp-figure {
  display: none;
}
.mfp-hide {
  display: none !important;
}
.mfp-preloader {
  color: #ccc;
  position: absolute;
  top: 50%;
  width: auto;
  text-align: center;
  margin-top: -0.8em;
  left: 8px;
  right: 8px;
  z-index: 1044;
}
.mfp-preloader a {
  color: #ccc;
}
.mfp-preloader a:hover {
  color: #fff;
}
.mfp-s-ready .mfp-preloader {
  display: none;
}
.mfp-s-error .mfp-content {
  display: none;
}
button.mfp-close,
button.mfp-arrow {
  overflow: visible;
  cursor: pointer;
  background: transparent;
  border: 0;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  display: block;
  padding: 0;
  z-index: 1046;
}
button::-moz-focus-inner {
  padding: 0;
  margin: 0;
}
.mfp-close {
  width: 44px;
  height: 44px;
  line-height: 44px;
  position: absolute;
  right: 0;
  top: 0;
  text-decoration: none;
  text-align: center;
  opacity: 0.65;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=65)";
  filter: alpha(opacity=65);
  padding: 0 0 18px 10px;
  color: #fff;
  font-style: normal;
  font-size: 28px;
}
.mfp-close:hover,
.mfp-close:focus {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.mfp-close:active {
  top: 1px;
}
.mfp-close-btn-in .mfp-close {
  color: #333;
}
.mfp-image-holder .mfp-close,
.mfp-iframe-holder .mfp-close {
  color: #fff;
  right: -6px;
  text-align: right;
  padding-right: 6px;
  width: 100%;
}
.mfp-counter {
  position: absolute;
  top: 0;
  right: 0;
  color: #ccc;
  font-size: 12px;
  line-height: 18px;
}
.mfp-arrow {
  position: absolute;
  opacity: 0.65;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=65)";
  filter: alpha(opacity=65);
  margin: 0;
  top: 50%;
  margin-top: -55px;
  padding: 0;
  width: 90px;
  height: 110px;
  -webkit-tap-highlight-color: rgba(0,0,0,0);
}
.mfp-arrow:active {
  margin-top: -54px;
}
.mfp-arrow:hover,
.mfp-arrow:focus {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.mfp-arrow:before,
.mfp-arrow:after,
.mfp-arrow .mfp-b,
.mfp-arrow .mfp-a {
  content: '';
  display: block;
  width: 0;
  height: 0;
  position: absolute;
  left: 0;
  top: 0;
  margin-top: 35px;
  margin-left: 35px;
  border: solid transparent;
}
.mfp-arrow:after,
.mfp-arrow .mfp-a {
  border-top-width: 13px;
  border-bottom-width: 13px;
  top: 8px;
}
.mfp-arrow:before,
.mfp-arrow .mfp-a {
  border-top-width: 21px;
  border-bottom-width: 21px;
}
.mfp-arrow-left {
  left: 0;
}
.mfp-arrow-left:after,
.mfp-arrow-left .mfp-a {
  border-right: 17px solid #fff;
  margin-left: 31px;
}
.mfp-arrow-left:before,
.mfp-arrow-left .mfp-b {
  margin-left: 25px;
}
.mfp-arrow-right {
  right: 0;
}
.mfp-arrow-right:after,
.mfp-arrow-right .mfp-a {
  border-left: 17px solid #fff;
  margin-left: 39px;
}
.mfp-iframe-holder {
  padding-top: 40px;
  padding-bottom: 40px;
}
.mfp-iframe-holder .mfp-content {
  line-height: 0;
  width: 100%;
  max-width: 900px;
}
.mfp-iframe-scaler {
  width: 100%;
  height: 0;
  overflow: hidden;
  padding-top: 56.25%;
}
.mfp-iframe-scaler iframe {
  position: absolute;
  display: block;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  -webkit-box-shadow: 0 0 8px rgba(0,0,0,0.4);
  box-shadow: 0 0 8px rgba(0,0,0,0.4);
  background: #000;
}
.mfp-iframe-holder .mfp-close {
  top: -40px;
}
img.mfp-img {
  width: auto;
  max-width: 100%;
  height: auto;
  display: block;
  line-height: 0;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  padding: 40px 0 40px;
  margin: 0 auto;
}
.mfp-figure {
  line-height: 0;
}
.mfp-figure:after {
  content: '';
  position: absolute;
  left: 0;
  top: 40px;
  bottom: 40px;
  display: block;
  right: 0;
  width: auto;
  height: auto;
  z-index: -1;
  -webkit-box-shadow: 0 0 8px rgba(0,0,0,0.4);
  box-shadow: 0 0 8px rgba(0,0,0,0.4);
  background: #444;
}
.mfp-bottom-bar {
  margin-top: -36px;
  position: absolute;
  top: 100%;
  left: 0;
  width: 100%;
  cursor: auto;
}
.mfp-title {
  text-align: left;
  line-height: 18px;
  color: #f3f3f3;
  word-break: break-word;
  padding-right: 36px;
}
.mfp-figure small {
  color: #bdbdbd;
  display: block;
  font-size: 12px;
  line-height: 14px;
}
.mfp-image-holder .mfp-content {
  max-width: 100%;
}
.mfp-gallery .mfp-image-holder .mfp-figure {
  cursor: pointer;
}
.mfp-fade.mfp-bg {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: all 0.15s ease-out;
  -moz-transition: all 0.15s ease-out;
  -o-transition: all 0.15s ease-out;
  -ms-transition: all 0.15s ease-out;
  transition: all 0.15s ease-out;
}
.mfp-fade.mfp-bg.mfp-ready {
  opacity: 0.8;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
  filter: alpha(opacity=80);
}
.mfp-fade.mfp-bg.mfp-removing {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.mfp-fade.mfp-wrap .mfp-content {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: all 0.15s ease-out;
  -moz-transition: all 0.15s ease-out;
  -o-transition: all 0.15s ease-out;
  -ms-transition: all 0.15s ease-out;
  transition: all 0.15s ease-out;
}
.mfp-fade.mfp-wrap.mfp-ready .mfp-content {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.mfp-fade.mfp-wrap.mfp-removing .mfp-content {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.mfp-zoom-in .mfp-with-anim {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: all 0.2s ease-in-out;
  -moz-transition: all 0.2s ease-in-out;
  -o-transition: all 0.2s ease-in-out;
  -ms-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
  -webkit-transform: scale(0.8);
  -moz-transform: scale(0.8);
  -o-transform: scale(0.8);
  -ms-transform: scale(0.8);
  transform: scale(0.8);
}
.mfp-zoom-in.mfp-bg {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: all 0.3s ease-out;
  -moz-transition: all 0.3s ease-out;
  -o-transition: all 0.3s ease-out;
  -ms-transition: all 0.3s ease-out;
  transition: all 0.3s ease-out;
}
.mfp-zoom-in.mfp-ready .mfp-with-anim {
  opacity: 1;
  -ms-filter: none;
  filter: none;
  -webkit-transform: scale(1);
  -moz-transform: scale(1);
  -o-transform: scale(1);
  -ms-transform: scale(1);
  transform: scale(1);
}
.mfp-zoom-in.mfp-ready.mfp-bg {
  opacity: 0.8;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
  filter: alpha(opacity=80);
}
.mfp-zoom-in.mfp-removing .mfp-with-anim {
  -webkit-transform: scale(0.8);
  -moz-transform: scale(0.8);
  -o-transform: scale(0.8);
  -ms-transform: scale(0.8);
  transform: scale(0.8);
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.mfp-zoom-in.mfp-removing.mfp-bg {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.mfp-newspaper .mfp-with-anim {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: all 0.2s ease-in-out;
  -moz-transition: all 0.2s ease-in-out;
  -o-transition: all 0.2s ease-in-out;
  -ms-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
  -webkit-transform: scale(0) rotate(500deg);
  -moz-transform: scale(0) rotate(500deg);
  -o-transform: scale(0) rotate(500deg);
  -ms-transform: scale(0) rotate(500deg);
  transform: scale(0) rotate(500deg);
}
.mfp-newspaper.mfp-bg {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: 0.5s;
  -moz-transition: 0.5s;
  -o-transition: 0.5s;
  -ms-transition: 0.5s;
  transition: 0.5s;
}
.mfp-newspaper.mfp-ready .mfp-with-anim {
  opacity: 1;
  -ms-filter: none;
  filter: none;
  -webkit-transform: scale(1) rotate(0deg);
  -moz-transform: scale(1) rotate(0deg);
  -o-transform: scale(1) rotate(0deg);
  -ms-transform: scale(1) rotate(0deg);
  transform: scale(1) rotate(0deg);
}
.mfp-newspaper.mfp-ready.mfp-bg {
  opacity: 0.8;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
  filter: alpha(opacity=80);
}
.mfp-newspaper.mfp-removing .mfp-with-anim {
  -webkit-transform: scale(0) rotate(500deg);
  -moz-transform: scale(0) rotate(500deg);
  -o-transform: scale(0) rotate(500deg);
  -ms-transform: scale(0) rotate(500deg);
  transform: scale(0) rotate(500deg);
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.mfp-newspaper.mfp-removing.mfp-bg {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.mfp-move-horizontal .mfp-with-anim {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
  -webkit-transform: translateX(-50px);
  -moz-transform: translateX(-50px);
  -o-transform: translateX(-50px);
  -ms-transform: translateX(-50px);
  transform: translateX(-50px);
}
.mfp-move-horizontal.mfp-bg {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
.mfp-move-horizontal.mfp-ready .mfp-with-anim {
  opacity: 1;
  -ms-filter: none;
  filter: none;
  -webkit-transform: translateX(0);
  -moz-transform: translateX(0);
  -o-transform: translateX(0);
  -ms-transform: translateX(0);
  transform: translateX(0);
}
.mfp-move-horizontal.mfp-ready.mfp-bg {
  opacity: 0.8;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
  filter: alpha(opacity=80);
}
.mfp-move-horizontal.mfp-removing .mfp-with-anim {
  -webkit-transform: translateX(50px);
  -moz-transform: translateX(50px);
  -o-transform: translateX(50px);
  -ms-transform: translateX(50px);
  transform: translateX(50px);
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.mfp-move-horizontal.mfp-removing.mfp-bg {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.mfp-move-from-top .mfp-content {
  vertical-align: top;
}
.mfp-move-from-top .mfp-with-anim {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: 0.2s;
  -moz-transition: 0.2s;
  -o-transition: 0.2s;
  -ms-transition: 0.2s;
  transition: 0.2s;
  -webkit-transform: translateY(-100px);
  -moz-transform: translateY(-100px);
  -o-transform: translateY(-100px);
  -ms-transform: translateY(-100px);
  transform: translateY(-100px);
}
.mfp-move-from-top.mfp-bg {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: 0.2s;
  -moz-transition: 0.2s;
  -o-transition: 0.2s;
  -ms-transition: 0.2s;
  transition: 0.2s;
}
.mfp-move-from-top.mfp-ready .mfp-with-anim {
  opacity: 1;
  -ms-filter: none;
  filter: none;
  -webkit-transform: translateY(0);
  -moz-transform: translateY(0);
  -o-transform: translateY(0);
  -ms-transform: translateY(0);
  transform: translateY(0);
}
.mfp-move-from-top.mfp-ready.mfp-bg {
  opacity: 0.8;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
  filter: alpha(opacity=80);
}
.mfp-move-from-top.mfp-removing .mfp-with-anim {
  -webkit-transform: translateY(-50px);
  -moz-transform: translateY(-50px);
  -o-transform: translateY(-50px);
  -ms-transform: translateY(-50px);
  transform: translateY(-50px);
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.mfp-move-from-top.mfp-removing.mfp-bg {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.mfp-3d-unfold .mfp-content {
  -webkit-perspective: 2000px;
  -moz-perspective: 2000px;
  -ms-perspective: 2000px;
  perspective: 2000px;
}
.mfp-3d-unfold .mfp-with-anim {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: 0.3s ease-in-out;
  -moz-transition: 0.3s ease-in-out;
  -o-transition: 0.3s ease-in-out;
  -ms-transition: 0.3s ease-in-out;
  transition: 0.3s ease-in-out;
  -webkit-transform-style: preserve-3d;
  -moz-transform-style: preserve-3d;
  -o-transform-style: preserve-3d;
  -ms-transform-style: preserve-3d;
  transform-style: preserve-3d;
  -webkit-transform: rotateY(-60deg);
  -moz-transform: rotateY(-60deg);
  -o-transform: rotateY(-60deg);
  -ms-transform: rotateY(-60deg);
  transform: rotateY(-60deg);
}
.mfp-3d-unfold.mfp-bg {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: 0.5s;
  -moz-transition: 0.5s;
  -o-transition: 0.5s;
  -ms-transition: 0.5s;
  transition: 0.5s;
}
.mfp-3d-unfold.mfp-ready .mfp-with-anim {
  opacity: 1;
  -ms-filter: none;
  filter: none;
  -webkit-transform: rotateY(0deg);
  -moz-transform: rotateY(0deg);
  -o-transform: rotateY(0deg);
  -ms-transform: rotateY(0deg);
  transform: rotateY(0deg);
}
.mfp-3d-unfold.mfp-ready.mfp-bg {
  opacity: 0.8;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
  filter: alpha(opacity=80);
}
.mfp-3d-unfold.mfp-removing .mfp-with-anim {
  -webkit-transform: rotateY(60deg);
  -moz-transform: rotateY(60deg);
  -o-transform: rotateY(60deg);
  -ms-transform: rotateY(60deg);
  transform: rotateY(60deg);
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.mfp-3d-unfold.mfp-bg {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.mfp-zoom-out .mfp-with-anim {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: 0.3s ease-in-out;
  -moz-transition: 0.3s ease-in-out;
  -o-transition: 0.3s ease-in-out;
  -ms-transition: 0.3s ease-in-out;
  transition: 0.3s ease-in-out;
  -webkit-transform: scale(1.3);
  -moz-transform: scale(1.3);
  -o-transform: scale(1.3);
  -ms-transform: scale(1.3);
  transform: scale(1.3);
}
.mfp-zoom-out.mfp-bg {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: 0.3s ease-out;
  -moz-transition: 0.3s ease-out;
  -o-transition: 0.3s ease-out;
  -ms-transition: 0.3s ease-out;
  transition: 0.3s ease-out;
}
.mfp-zoom-out.mfp-ready .mfp-with-anim {
  opacity: 1;
  -ms-filter: none;
  filter: none;
  -webkit-transform: scale(1);
  -moz-transform: scale(1);
  -o-transform: scale(1);
  -ms-transform: scale(1);
  transform: scale(1);
}
.mfp-zoom-out.mfp-ready.mfp-bg {
  opacity: 0.8;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
  filter: alpha(opacity=80);
}
.mfp-zoom-out.mfp-removing .mfp-with-anim {
  -webkit-transform: scale(1.3);
  -moz-transform: scale(1.3);
  -o-transform: scale(1.3);
  -ms-transform: scale(1.3);
  transform: scale(1.3);
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.mfp-zoom-out.mfp-removing.mfp-bg {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.mfp-dialog {
  background: #fff;
  padding: 20px 30px;
  text-align: left;
  max-width: 475px;
  margin: 40px auto;
  position: relative;
}
.mfp-search-dialog {
  max-width: 800px;
}
.tweet-list {
  list-style: none;
  margin: 0;
  padding: 0;
}
.twitter .tweet-list li {
  margin-bottom: 15px;
  position: relative;
  padding-left: 25px;
}
.twitter .tweet-list li:before {
  content: '\f099';
  font-family: 'FontAwesome';
  position: absolute;
  top: 0;
  left: 0;
}
.twitter-ticker .tweet-list {
  height: 4.7em;
  overflow-y: hidden;
}
.twitter-ticker .tweet-list li {
  height: 4.7em;
  line-height: 16px;
}
.comments-list {
  margin: 0;
  padding: 0;
  list-style: none;
}
.comments-list ul {
  list-style: none;
}
.comments-list li ul {
  margin-left: 25px;
}
.comment {
  margin-bottom: 25px;
  overflow: hidden;
}
.comment .comment-review-rate {
  margin: 0;
  color: <?php echo $themecolor;?>;
  font-size: 13px;
}
.comment .comment-author {
  float: left;
  margin-right: 10px;
}
.comment .comment-author img {
  -webkit-border-radius: 50%;
  border-radius: 50%;
}
.comment .comment-inner {
  display: table;
}
.comment .comment-content {
  margin: 3px 0;
  padding-bottom: 10px;
  border-bottom: 1px dashed #e6e6e6;
}
.comment .comment-author-name {
  font-size: 12px;
  color: #888;
  margin: 0;
}
.comment .comment-time {
  font-size: 12px;
  margin-right: 10px;
  color: #8f8f8f;
}
.comment .comment-like {
  float: right;
  opacity: 0.3;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=30)";
  filter: alpha(opacity=30);
  -webkit-transition: 0.2s;
  -moz-transition: 0.2s;
  -o-transition: 0.2s;
  -ms-transition: 0.2s;
  transition: 0.2s;
  font-size: 12px;
  font-weight: bold;
}
.comment .comment-like [class^="fa fa-"] {
  font-weight: normal;
}
.comment .comment-reply {
  [class^="fa fa-"]: 13px;
}
.comment:hover .comment-like {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.fontawesome-icon-list .fa-hover {
  margin-bottom: 10px;
}
.fontawesome-icon-list .fa-hover > a {
  color: #000;
  font-size: 11px;
}
.fontawesome-icon-list .fa-hover > a .fa {
  color: #515151;
  width: 20px;
  text-align: center;
  margin-right: 7px;
  font-size: 14px;
  position: relative;
}
.demo-grid .row {
  margin-bottom: 20px;
}
.demo-grid .row [class^="col-"] > div {
  height: 20px;
  background: #999;
}
.demo-grid h5 {
  font-size: 14px;
  margin-bottom: 3px;
  color: #888;
}
.preview-area {
  text-align: center;
}
.preview-item {
  opacity: 0.85;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=85)";
  filter: alpha(opacity=85);
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
.preview-item:hover {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.preview-item:hover .preview-img {
  -webkit-transform: translate(0, -5px) scale(1.05);
  -moz-transform: translate(0, -5px) scale(1.05);
  -o-transform: translate(0, -5px) scale(1.05);
  -ms-transform: translate(0, -5px) scale(1.05);
  transform: translate(0, -5px) scale(1.05);
}
.preview-img {
  display: block;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
.preview-desc {
  color: #fff;
  margin: 10px 20px 20px 20px;
  font-size: 13px;
}
.preview-title {
  text-transform: uppercase;
  display: table;
  line-height: 1em;
  padding: 5px 7px;
  background: <?php echo $themecolor;?>;
  margin: 0 auto;
}
.preview-title > a {
  color: #fff;
}
.preview-logo {
  width: auto;
  display: inline-block;
  margin-top: 40px;
  margin-bottom: 10px;
}
.ri-grid {
  position: relative;
  height: auto;
  width: 100%;
}
.ri-grid ul {
  list-style: none;
  display: block;
  width: 100%;
  margin: 0;
  padding: 0;
  zoom: 1;
}
.ri-grid ul:before,
.ri-grid ul:after {
  content: '';
  display: table;
}
.ri-grid ul:after {
  clear: both;
}
.ri-grid ul li {
  -webkit-perspective: 400px;
  -moz-perspective: 400px;
  -ms-perspective: 400px;
  perspective: 400px;
  margin: 0;
  padding: 0;
  float: left;
  position: relative;
  display: block;
  overflow: hidden;
  -webkit-transition: opacity 0.5s;
  -moz-transition: opacity 0.5s;
  -o-transition: opacity 0.5s;
  -ms-transition: opacity 0.5s;
  transition: opacity 0.5s;
}
.ri-grid ul li:hover {
  opacity: 0.5;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
  filter: alpha(opacity=50);
}
.ri-grid ul li a {
  display: block;
  outline: none;
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  -webkit-backface-visibility: hidden;
  -moz-backface-visibility: hidden;
  -ms-backface-visibility: hidden;
  backface-visibility: hidden;
  -webkit-transform-style: preserve-3d;
  -moz-transform-style: preserve-3d;
  -o-transform-style: preserve-3d;
  -ms-transform-style: preserve-3d;
  transform-style: preserve-3d;
  -webkit-background-size: 100% 100%;
  -moz-background-size: 100% 100%;
  background-size: 100% 100%;
  background-position: center center;
  background-repeat: no-repeat;
  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
}
.errr{color:#FF0000;cursor:pointer;}
.succ{color:#008000;cursor:pointer;}
.error input[type="text"]{
border-color:#FF0000;
}
.error input[type="text"]::-webkit-input-placeholder{
color:red;
}
.error input[type="text"]:-moz-placeholder{color:red;}
.error input[type="text"]::-moz-placeholder{color:red;}
.error input[type="text"]:-ms-input-placeholder{color:red;}
.error .validatemsg,.error .validatemg{display:block;}
.validatemsg,.validatemg{color:#FF0000;display:none;cursor:pointer;}
.layover {
	width: 100%;
	text-align: center;
	margin: 0;
	display: table;
	font-size: 1.3em;
	color:#252323;
	//color: #ffffff;
	//background: url(../img/bt_border.png) no-repeat;
    font-weight: bold;
    padding: 10px 0;
}
.layover .layovertext,.layover .layoverline{display:inline-block;vertical-align:middle;}
.layover .layovertext{width:30%;}
.layover .layoverline{height:3px;background:#3276b1;width:35%;}
.non-refundable {
	background: none repeat scroll 0 0 rgb(238, 0, 0);
	color: rgb(255, 255, 255);
	font-size: 13px;
	height: 15%;
	position: absolute;
	right: 0;
	text-align: center;
	top: 0;
	width: 15px;
	margin-right: 0px;
	
}
.non-refundable span{
	display: block; margin-top:-10px;
	transform: rotate(-90deg);
	transform-origin: 59px 60px 0px;
	-ms-transform: rotate(-90deg);
	-ms-transform-origin: 59px 60px 0px;
	-webkit-transform: rotate(-90deg);
	-webkit-transform-origin:59px 59px 0px;
	-moz-transform: rotate(-90deg);
	-moz-transform-origin: 59px 60px 0px;
}
.refundable{
	background:#03992F;
	color: rgb(255, 255, 255);
	font-size: 13px;
	height: 15%;
	position: absolute;
	right: 0;
	text-align: center;
	top: 0;
	width: 15px;
	margin-right: 0px;
}
.refundable span{
	display: block;
	transform: rotate(-90deg);
	transform-origin: 50px 51px 0px;
	-ms-transform: rotate(-90deg);
	-ms-transform-origin: 50px 51px;
	-webkit-transform: rotate(-90deg);
	-webkit-transform-origin: 50px 50px 0px;
	-moz-transform: rotate(-90deg);
	-moz-transform-origin: 50px 51px 0px;
}
.booking-item-price.crossed-price {
  font-size: 11px;
  display: block;
}
.booking-item-price.crossed-price.nocross {
  text-decoration: none;
}
.booking-item-price.crossed-price span {
  color: #555;
  font-size: 18px;
  vertical-align: top;
  position: relative;
}
.booking-item-price.crossed-price > span::after {
  background: none repeat scroll 0 0 #f00;
  content: "";
  display: block;
  height: 1px;
  margin-top: -6px;
  position: absolute;
  width: 100%;
}
.fare-breakup{
	border-left: 1px solid;
}
@media (max-width:992px) {
	.fare-breakup{
		border-top: 1px solid;
		border-left: none;
	}
}
.fare-breakup .row{
	padding-left: 10px;
	border-bottom: 1px dashed;
	font-size: 14px;
}
.fare-breakup .row.total-fare {
  font-size: 16px;
  font-weight: bold;
  padding: 5px 0 5px 10px;
}
.booking-item-departure.w52percent{
	width: 52%;
}
.booking-item-arrival.w42percent{
	width: 42%;
}
[data-toggle~="tooltip"] {
	cursor: pointer;
}
.round-saperator {
  color: #0a0644;
  display: table;
  font-size: 1em;
  height: 1.5em;
  margin: -15px 0 5px;
  position: relative;
  width: 100%;
}
.round-saperator .rsaptext {
  background: none repeat scroll 0 0 #fff;
  left: 0;
  position: absolute;
  top: 0;
  z-index: 1;
}
.round-saperator .rsaptext i {
  font-size: 1.3em;
}
.round-saperator .rsapline {
  background: none repeat scroll 0 0 #3276b1;
  //border-style: dotted;
  //color: #2e921c;
  height: 3px;
  left: 0;
  position: absolute;
  top: 45%;
  width: 100%;
  z-index: 0;
}
@media (min-width:992px) {
.col-md-5.col-4_5{
	width: 37.5%;
	border-right: 1px solid #ccc;
}
.col-md-5.col-4_5:last-child{
	border: none;
}
.col-md-5.col-4_5 .booking-item .col-md-3 h5{
	font-size: 1.2em;
}
.layover.dom-return{
	display: none;
}
}
@media (max-width:992px) {
.col-md-5.col-4_5{
	border: none;
	margin-top: 20px;
}
.col-md-5.col-4_5:last-child{
	border: none;
}
}
 
</style>