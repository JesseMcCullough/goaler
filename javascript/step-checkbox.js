let steps = document.querySelectorAll(".goal.step");
for (let step of steps) {
    step.addEventListener("click", function() {
        let checkbox = step.querySelector(".checkbox");
        let isCompleted = !checkbox.classList.contains("checked"); // toggling "checked" after verifcation.

        let requestUrl = "includes/step/edit-step-completion.php";
        let params = "goalId=" + goalId
                + "&stepId=" + step.dataset.stepId
                + "&isCompleted=" + isCompleted;
        
        let goalRequest = new XMLHttpRequest();
        goalRequest.open("POST", requestUrl, true);
        goalRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        goalRequest.onload = function() {
            if (this.status == 200) {
                let progressPercentage = this.responseText;

                if (progressPercentage == "unverified") {
                    location.href = "index.php";
                    return;
                }

                checkbox.classList.toggle("checked");
                
                document.querySelector(".progress .completion-bar").style.width = progressPercentage;
                document.querySelector(".progress .percent").innerHTML = progressPercentage;
            }
        };
        goalRequest.send(params);
    });
}