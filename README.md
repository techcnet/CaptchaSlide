# Slide Captcha module for ProcessWire

![GitHub](https://img.shields.io/github/license/techcnet/SlideCaptcha)
![GitHub last commit](https://img.shields.io/github/last-commit/techcnet/SlideCaptcha)
[![](https://img.shields.io/static/v1?label=Sponsor&message=%E2%9D%A4&logo=GitHub&color=%23fe8e86)](https://github.com/sponsors/techcnet)

This module provides Captcha functionality to ProcessWire. This specific captcha uses a puzzle that has to be solved by pulling the slider into the correct position. In contrast to other graphical captchas, this captcha also verifies the result on the server side. No jQuery is required. Only PHP and JavaScript.

!["Screenshot"](https://tech-c.net/site/assets/files/1235/slide-captcha.jpg)

After module installation the source code in the page has to be modified as described in the following 3 examples.

## Example 1
This example shows, how to use the captcha with a form-submit and the captcha on the submit-button.
Insert a onclick-listener in the button-tag:

````html
<button onclick="javascript:captcha('testform');return false;">Submit</button>
````

Add the JavaScript:

````html
<script>
  function captcha(form) {
    slideCaptcha.onsuccess(function () {
      document.getElementById(form).submit();
      slideCaptcha.hide();
      slideCaptcha.refresh();
    });
    slideCaptcha.init();
    slideCaptcha.show();
  }
</script>
````

The form is not submitted by clicking on the button. Instead, the captcha is displayed. If the captcha has been solved correctly, the form is submitted. Check again on the server side, whether the captcha has really been solved:

````php
<?php
  session_start();
  if ((isset($_POST['send'])) && ($_POST['send'] == '1')) {
    if ((isset($_SESSION['SlideCaptchaOk'])) && ($_SESSION['SlideCaptchaOk'] == 'ok')) {
      unset($_SESSION['SlideCaptchaOk']);
      echo '<p style="color:lime">Form submit received: Captcha solved</p>';
    } else {
      echo '<p style="color:red">Form submit received: Captcha NOT solved.</p>';
    }
  }
?>
````

## Example 2
This example shows, how to use the captcha with a form-submit and the captcha on a checkbox.
Insert a onclick-listener in the checkbox-tag:

````html
<input id="id_checkbox" type="checkbox" required="required" onclick="javascript:captcha('id_checkbox');return false;" />
````

Add the JavaScript:

````html
<script>
  function captcha(checkbox) {
    slideCaptcha.init();
    slideCaptcha.show();      
    slideCaptcha.onsuccess(function () {
      document.getElementById(checkbox).checked = true;
      slideCaptcha.hide();
      slideCaptcha.refresh();
    });
  }
</script>
````

By using the required option inside the checkbox-tag, the form can only be submitted when the checkbox is checked. By clicking on the checkbox, the captcha is displayed. If the captcha has been solved correctly, the checkbox will be checked and the form can be submitted. Check again on the server side, as described in example 1, whether the captcha has really been solved.

## Example 3
This example shows, how to use the captcha with a hyperlink.
Insert a onclick-listener in the hyperlink-tag. Also move the **href** link into the JavaScript-function:

````html
<a href="" onclick="javascript:captcha('Example3.php');return false;">DOWNLOAD</a>
````

Add the JavaScript:

````html
<script>
  function captcha(file) {
    slideCaptcha.onsuccess(function () {
      window.location.href = file;
      slideCaptcha.hide();
      slideCaptcha.refresh();
    });
    slideCaptcha.init();
    slideCaptcha.show();
  }
</script>
````

The captcha is displayed by clicking on the hyperlink. If the captcha has been solved correctly, the JavaScript will redirect to the specifed location. Check again on the server side, whether the captcha has really been solved and deliver the content:

````php
<?php
  session_start();
  if ((isset($_SESSION['SlideCaptchaOk'])) && ($_SESSION['SlideCaptchaOk'] == 'ok')) {
    unset($_SESSION['SlideCaptchaOk']);
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="Example3.php"');
    readfile('Example3.php');
    die();
  }
?>
````

## Module settings
The settings for this module are located in the menu Modules=>Configure=>CaptchaSlide.

!["Screenshot"](https://tech-c.net/site/assets/files/1235/settings.jpg)

### Filename
Filename which must not exist in the root directory and also not represents a page. The default filename resolves in to the following URL: https://domain.tld/captcha/. This URL receives the information from the client side JavaScript.

### Tolerance
Specifies a tolerance in order to offer better user experience. A tolerance of 3 means +- 3 pixel tolerance (3 recommended).

### Logging
Logs unsolved and solved Captcha attempts in the ProcessWire system logs.

### Pages
The JavaScript and CSS for the Captcha will be included into the following pages.

## Photos
All photos provided by ["unsplash.com"](https://unsplash.com). As described on their website, all photos, offered on their website, can be used for free for commercial and non-commercial purposes:

!["Photos"](https://tech-c.net/site/assets/files/1235/license.jpg)
