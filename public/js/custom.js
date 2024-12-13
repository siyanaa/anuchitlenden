// var currentTab = 0; // Current tab is set to be the first step (0)
// var maxReachedStep = 0; // Initialize the maximum reached step to the first step
// showTab(currentTab); // Display the current step

// function showTab(n) {
//   var steps = document.getElementsByClassName("step");
//   var tabs = document.getElementsByClassName("tab");

//   // Hide all tabs by default
//   for (var i = 0; i < tabs.length; i++) {
//     tabs[i].style.display = "none";
//   }

//   // Show the selected tab
//   tabs[n].style.display = "block";

//   //... and fix the Previous/Next buttons:
//   if (n == 0) {
//     document.getElementById("prevBtn").style.display = "none";
//   } else {
//     document.getElementById("prevBtn").style.display = "inline";
//   }
//   if (n == tabs.length - 1) {
//     document.getElementById("nextBtn").innerHTML = "Submit";
//   } else {
//     document.getElementById("nextBtn").innerHTML = "Next";
//   }

//   //... and run a function that will display the correct step indicator:
//   fixStepIndicator(n);
//   currentTab = n; // Update the currentTab value to reflect the clicked step
// }

// function nextPrev(n) {
//   var tabs = document.getElementsByClassName("tab");
//   var currentTabInputs = tabs[currentTab].getElementsByTagName("input");
//   var isValid = true;

//   // Validate inputs in the current step if moving to the next step
//   if (n == 1) {
//     for (var i = 0; i < currentTabInputs.length; i++) {
//       if (
//         currentTabInputs[i].hasAttribute("required") &&
//         currentTabInputs[i].value == ""
//       ) {
//         currentTabInputs[i].className += " invalid";
//         isValid = false;
//       }
//     }
//   }

//   // Proceed to the next step only if the current step is valid
//   if (isValid) {
//     tabs[currentTab].style.display = "none";
//     currentTab = currentTab + n;

//     // If you have reached the end of the steps, submit the form
//     if (currentTab >= tabs.length) {
//       document.getElementById("regForm").submit();
//       return false;
//     }

//     // Update the maximum reached step if moving to a higher step
//     if (n == 1) {
//       maxReachedStep = currentTab;
//     }

//     // If moving backward, find the last filled step
//     if (n == -1) {
//       for (var i = currentTab; i >= 0; i--) {
//         var prevTabInputs = tabs[i].getElementsByTagName("input");
//         var hasFilledInputs = false;
//         for (var j = 0; j < prevTabInputs.length; j++) {
//           if (prevTabInputs[j].value.trim() !== "") {
//             hasFilledInputs = true;
//             break;
//           }
//         }
//         if (hasFilledInputs) {
//           maxReachedStep = i;
//           break;
//         }
//       }
//     }

//     showTab(currentTab);
//   }
// }

// function fixStepIndicator(n) {
//   var steps = document.getElementsByClassName("step");
//   for (var i = 0; i < steps.length; i++) {
//     steps[i].className = steps[i].className.replace(" active", "");
//   }

//   //... and adds the "active" class on the current step:
//   steps[n].className += " active";
// }

// // Event listener for handling the click events on the steps
// var steps = document.getElementsByClassName("step");
// for (var i = 0; i < steps.length; i++) {
//   steps[i].addEventListener("click", function () {
//     var index = Array.prototype.indexOf.call(steps, this);
//     if (index <= maxReachedStep) {
//       showTab(index);
//     }
//   });
// }

// function fixStepIndicator(n) {
//   var steps = document.getElementsByClassName("step");
//   for (var i = 0; i < steps.length; i++) {
//     steps[i].className = steps[i].className.replace(" active", "");
//     if (i <= maxReachedStep) {
//       steps[i].classList.add("filled");
//       steps[i].classList.remove("unfilled");
//     } else {
//       steps[i].classList.remove("filled");
//       steps[i].classList.add("unfilled");
//     }
//   }
//   steps[n].classList.add("active");
// }

var registration_status = false;
var registration_status = $("#registration_form").attr("data-registration");
if (registration_status) {
    var currentTab = 0;
    var maxReachedStep = 0;
    showTab(currentTab);

    function showTab(n) {
        var steps = document.getElementsByClassName("step");
        var tabs = document.getElementsByClassName("tab");

        for (var i = 0; i < tabs.length; i++) {
            tabs[i].style.display = "none";
        }

        tabs[n].style.display = "block";

        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == tabs.length - 1) {
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }

        fixStepIndicator(n);
        currentTab = n;
    }

    function nextPrev(n) {
        var tabs = document.getElementsByClassName("tab");
        var currentTabInputs = tabs[currentTab].getElementsByTagName("input");
        var currentTabSelect = tabs[currentTab].getElementsByTagName("select");
        var isValid = true;

        console.log(currentTabSelect.length);

        if (n == 1) {
            for (var i = 0; i < currentTabInputs.length; i++) {
                if (
                    currentTabInputs[i].hasAttribute("required") &&
                    currentTabInputs[i].value == ""
                ) {
                    currentTabInputs[i].className += " invalid";
                    isValid = false;
                }
            }

            // Additional validation for the contact input when moving from 2nd to 3rd or 3rd to 4th
            var contactInput = document.getElementById("a_contact");
            if (contactInput && (currentTab === 1 || currentTab === 2)) {
                var contactValue = contactInput.value;
                if (
                    contactInput.hasAttribute("required") &&
                    (contactValue.length !== 10 || !/^\d+$/.test(contactValue))
                ) {
                    contactInput.classList.add("invalid");
                    isValid = false;
                }
            }

            if (currentTab === 2) {
                var offenderContactInput = document.getElementById("o_contact");
                if (offenderContactInput) {
                    var offenderContactValue = offenderContactInput.value;
                    if (
                        offenderContactInput.hasAttribute("required") &&
                        (offenderContactValue.length !== 10 ||
                            !/^\d+$/.test(offenderContactValue))
                    ) {
                        offenderContactInput.classList.add("invalid");
                        isValid = false;
                    }
                }
            }
        }

        if (n == 1) {
            for (var i = 0; i < currentTabSelect.length; i++) {
                if (
                    currentTabSelect[i].hasAttribute("required") &&
                    currentTabSelect[i].value == ""
                ) {
                    currentTabSelect[i].className += " invalid";
                    isValid = false;
                    console.log(currentTabSelect[i]);
                    console.log(isValid);
                }
            }
        }

        if (isValid) {
            tabs[currentTab].style.display = "none";
            currentTab = currentTab + n;

            if (currentTab >= tabs.length) {
                document.getElementById("regForm").submit();
                return false;
            }

            if (n == 1) {
                maxReachedStep = currentTab;
            }

            if (n == -1) {
                for (var i = currentTab; i >= 0; i--) {
                    var prevTabInputs = tabs[i].getElementsByTagName("input");
                    var hasFilledInputs = false;
                    for (var j = 0; j < prevTabInputs.length; j++) {
                        if (prevTabInputs[j].value.trim() !== "") {
                            hasFilledInputs = true;
                            break;
                        }
                    }
                    if (hasFilledInputs) {
                        maxReachedStep = i;
                        break;
                    }
                }
            }

            showTab(currentTab);
        }
    }

    function fixStepIndicator(n) {
        var steps = document.getElementsByClassName("step");
        for (var i = 0; i < steps.length; i++) {
            steps[i].className = steps[i].className.replace(" active", "");
            if (i <= maxReachedStep) {
                steps[i].classList.add("filled");
                steps[i].classList.remove("unfilled");
            } else {
                steps[i].classList.remove("filled");
                steps[i].classList.add("unfilled");
            }
        }
        steps[n].classList.add("active");
    }

    var steps = document.getElementsByClassName("step");
    for (var i = 0; i < steps.length; i++) {
        steps[i].addEventListener("click", function () {
            var index = Array.prototype.indexOf.call(steps, this);
            if (index <= maxReachedStep) {
                showTab(index);
            }
        });
    }
}

// Function to open the modal
function openModalcalc() {
    document.getElementById("modalcalc").style.display = "block";
}

// Function to close the modal
function closeModalcalc() {
    document.getElementById("modalcalc").style.display = "none";
}

// Attach an event listener to the button in your navbar
const openModalBtncalc = document.getElementById("openModalBtn");
openModalBtncalc.addEventListener("click", openModalcalc);

// Function to convert land measurements accurately
function convertLand() {
    const ropani = parseFloat(document.getElementById("ropani").value);
    const aana = parseFloat(document.getElementById("aana").value);
    const paisa = parseFloat(document.getElementById("paisa").value);
    const daam = parseFloat(document.getElementById("daam").value);

    // Convert to Bigha, Kattha, Dhur using the correct conversion factors
    let totalDhur = (ropani * 30.05) + (aana * 4) + (paisa * 4/16) + (daam * 1/256);
    let bigha = Math.floor(totalDhur / (20 * 20)); // 1 Bigha = 20 Kattha, and 1 Kattha = 20 Dhur
    let remainingDhur = totalDhur % (20 * 20);
    let kattha = Math.floor(remainingDhur / 20);
    let dhur = remainingDhur % 20;

    // Update the result display
    document.getElementById("result").innerHTML = "<p>बिघा-कठ्ठा-धुर:</p>";
    document.getElementById("result").innerHTML += "<p>" + bigha + "-" + kattha + "-" + dhur.toFixed(3) + "</p>";
}






















