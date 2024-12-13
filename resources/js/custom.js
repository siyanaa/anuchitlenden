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
    var isValid = true;

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
