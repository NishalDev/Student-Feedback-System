<script>
    function getCourse() {
        var departmentId = document.getElementById("inputDepartment").value;

        // Make an AJAX request to get_courses.php with the selected departmentId
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "get_courses.php?departmentId=" + departmentId, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status >= 200 && xhr.status < 400) {
                var courses = JSON.parse(xhr.responseText);
                var courseSelect = document.getElementById("inputCourse");

                // Clear previous options
                courseSelect.innerHTML = "";

                // Add the fetched courses as options
                for (var i = 0; i < courses.length; i++) {
                    var option = document.createElement("option");
                    option.value = courses[i].course_id;
                    option.text = courses[i].course_name;
                    option.style.color = "black"; // Set the font color to black
                    courseSelect.appendChild(option);
                }
            }
        };

        // Send the AJAX request
        xhr.send();
    }
</script>
<script>
    function getSubject() {
        var courseId = document.getElementById("inputCourse").value;
        var semesterId = document.getElementById("inputSemester").value;

        // Make an AJAX request to get_subject.php with the selected courseId and semesterId
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "get_subject.php?courseId=" + courseId + "&semesterId=" + semesterId, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status >= 200 && xhr.status < 400) {
                var subjects = JSON.parse(xhr.responseText);
                var subjectSelect = document.getElementById("inputSubject");

                // Clear previous options
                subjectSelect.innerHTML = "";

                // Add the fetched subjects as options
                for (var i = 0; i < subjects.length; i++) {
                    var option = document.createElement("option");
                    option.value = subjects[i].subject_id;
                    option.text = subjects[i].subject_name;
                    option.style.color = "black"; // Set the font color to black
                    subjectSelect.appendChild(option);
                }
            }
        };

        // Send the AJAX request
        xhr.send();
    }
</script>