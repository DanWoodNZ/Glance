var LoginModule = (function() {
  "use strict";
  // placeholder for cached DOM elements
  var DOM = {};

  /* =================== private methods ================= */
  // cache DOM elements
  function cacheDom() {
    DOM.$loginButton = $("#login-button");
    DOM.$emailInput = $("#email-input");
    DOM.$passwordInput = $("#password-input");
	 DOM.$staying_logged = $("#staying_logged");
    DOM.$loginForm = $("#login-form");
    DOM.$loginFormButton = $(".login-form-btn");
  }
  // bind events
  function bindEvents() {
    DOM.$loginForm.submit(function(e) {
      e.preventDefault(e);
      handleLoginButtonClick();
    });

    DOM.$loginFormButton.click(function() {
      animateLoginFormTransition(
        $(this)
          .closest("div")
          .add(".login-form")
      );
    });
  }
  // handle click events
  function handleLoginButtonClick() {
    var dynamicData = {};

    dynamicData = retrieveLoginInfoEntered();

    attemptLoginDB(dynamicData).done(function(data) {
      if (data == "success") {
        window.location.href = "week-calendar.php";
      } else {
        alert(data);
        DOM.$emailInput.val("");
        DOM.$passwordInput.val("");
      }
    });
  }

  function retrieveLoginInfoEntered() {
    var email = "",
      password = "",
      staying_logged="";

    email = DOM.$emailInput.val();
    password = DOM.$passwordInput.val();
    staying_logged = DOM.$staying_logged.prop("checked");

    return { email: email, password: password, staying_logged: staying_logged };
  }

  function animateLoginFormTransition() {}

  function isEmail() {}

  /* =================== private AJAX methods ================= */
  function attemptLoginDB(dynamicData) {
    return $.post("php/user-profile/login.php", { dynamicData: dynamicData });
  }

  /* =================== public methods ================== */
  // main init method
  function init(SharedFunctions) {
    cacheDom();
    bindEvents();
    isEmail = SharedFunctions.isEmail;
    animateLoginFormTransition = SharedFunctions.animateLoginFormTransition;
  }

  /* =============== export public methods =============== */
  return {
    init: init
  };
})();
