/**
 * @package Destiny Cookie Plugin
 * @version 1.0.9
 * @copyright Copyright (C) 2021 Destiny B.V., All rights reserved.
 * @license GNU General Public License version 3 or later; see LICENSE.txt
 * @author url: https://www.destiny.nl
 * @author email publicanda@destiny.nl
 *
 * Destiny Cookie Plugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 */

"use strict";

// Remove the popup modal
function closePopup() {
  var popupElement = document.getElementById("dcpbanner");
  popupElement.classList.remove("light");
  popupElement = document.getElementById("dcppopup");
  popupElement.classList.remove("modal-open");
}

// Show the popup modal
function openPopup() {
  var popupElement = document.getElementById("dcpbanner");
  popupElement.classList.add("light");
  popupElement = document.getElementById("dcppopup");
  popupElement.classList.add("modal-open");
}

// setCookie helper
function setCookie(functional, analytics, marketing) {
  var date = new Date();
  date.setTime(date.getTime() + 365 * 24 * 60 * 60 * 1000);
  var expires = "; expires=" + date.toGMTString();
  document.cookie = "destinycp=" + JSON.stringify({
    func: functional,
    ana: analytics,
    mar: marketing
  }) + expires + "; path=/";
}

// Process chosen settings and store in cookie
function processSettings() {
  var functional = "yes";
  var analytics = document.getElementById("analytics").checked ? "yes" : "no";
  var marketing = document.getElementById("marketing").checked ? "yes" : "no";
  setCookie(functional, analytics, marketing);
  closePopup();
  window.location.reload();
}

// Process chosen settings and store in cookie
function acceptAll() {
  var functional = "yes";
  var analytics = "yes";
  var marketing = "yes";
  setCookie(functional, analytics, marketing);
}

// setClass helper
function setClass(els, className, fnName) {
  for (var i = 0; i < els.length; i++) {
    els[i].classList[fnName](className);
  }
}

// Get cookie value
function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(";");

  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];

    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }

    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }

  return "";
}

// Process settings when Accept button is pressed
window.onload = function () {
  // Read cookie settings at startup and set checkboxes accordingly
  var destinycp = getCookie("destinycp");

  if (destinycp) {
    var cookieSettings = JSON.parse(destinycp);

    if (cookieSettings["ana"] == "yes") {
      document.getElementById("analytics").checked = true;
    } else {
      document.getElementById("analytics").checked = false;
    }

    if (cookieSettings["mar"] == "yes") {
      document.getElementById("marketing").checked = true;
    } else {
      document.getElementById("marketing").checked = false;
    }
  }

  // Handle accordions
  var acc = document.getElementsByClassName("collapsible");
  var panel = document.getElementsByClassName("content");

  for (var i = 0; i < acc.length; i++) {
    acc[i].onclick = function () {
      var setClasses = !this.classList.contains("active");
      setClass(acc, "active", "remove");
      setClass(panel, "show", "remove");

      if (setClasses) {
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
      }
    };
  }

  // Process settings when Accept button in banner is pressed
  document.getElementById("dcp-accept").addEventListener("click", function () {
    acceptAll();
    window.location.reload();
  });

  // Process settings when Set button in banner is pressed
  document.getElementById("dcp-set").addEventListener("click", function () {
    openPopup();
  });

  // Process settings when Save button in popup is pressed
  document.getElementById("save").addEventListener("click", function () {
    processSettings();
  });

  // Process settings when Accept button in popup is pressed
  document.getElementById("accept").addEventListener("click", function () {
    acceptAll();
    window.location.reload();
  });

  // Close modal when close button pressed
  document.getElementById("close").addEventListener("click", function () {
    closePopup();
  });
};