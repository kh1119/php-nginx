<?php
if ($setting['css'] || $style) {
  echo '<style>';
  echo $setting['css'];
  if ($style['a1']) {
    echo "
    body,#main {
      background: {$style['a1']}
    }
    ";
  }
  if ($style['a2']) {
    echo "body {color: {$style['a2']};}";
  }
  if ($style['a3']) {
    echo "a {color: {$style['a3']};}";
  }
  if ($style['a4']) {
    echo "a:hover {color: {$style['a4']};}";
  }
  if ($style['a5']) {
    $rgb  = rgb($style['a5']);
    echo "
    #ani_detail .ani_detail-stage {
      background: rgba({$rgb},0.6);
    }
    #footer,#header,#text-home,#header.home-header,.deslide-wrap {
      background: rgba({$rgb},0.8);
    }
    ";
  }
  if ($style['b1']) {
    $rgb  = rgb($style['b1']);
    echo ".btn-primary {background: {$style['b1']};border-color:{$style['b1']}}";
    echo ".btn-primary:hover,.btn-primary:focus,.btn-primary:active {background: rgba({$rgb},0.8);}";
  }
  if ($style['b2']) {
    echo ".btn-primary {color: {$style['b2']}}";
  }

  if ($style['h1']) {
    echo "#header,#text-home,#header.home-header,.deslide-wrap {background: {$style['h1']};}";
  }
  if ($style['h2']) {
    echo "#header_menu ul.header_menu-list .nav-item>a {color: {$style['h2']};}";
  }
  if ($style['h3']) {
    echo "#header_menu ul.header_menu-list .nav-item>a:hover {color: {$style['h3']};}";
  }
  if ($style['f1']) {
    echo "#footer {background: {$style['f1']};}";
  }
  if ($style['f2']) {
    echo "#footer {color: {$style['f2']};}";
  }
  if ($style['f3']) {
    echo "#footer a{color: {$style['f3']};}";
  }
  if ($style['f4']) {
    echo "#footer a:hover{color: {$style['f4']};}";
  }
  echo un_htmlchars($style['css']);
  echo '</style>';
}
