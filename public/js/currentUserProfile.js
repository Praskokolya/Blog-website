function showAllForms() {
    allForms = document.querySelectorAll("form");
    allFormsData = allForms.forEach((form) => {
        form.style.display = "block";
    });

    buttonWhichWillBeDeleted = document.getElementById("buttonDelete");
    buttonWhichWillBeDeleted.remove();

    buttonWillBeShow = document.querySelector(".hiddenbtn");
    buttonWillBeShow.style.display = "block";

    const defaultValues = document.querySelector(".currentDataInterests");
    const defaultValueNickname = document.querySelector(".currentDataNickname");
    const defaultValueBirthdate = document.querySelector(".currentDataBirthdate");
    const defaultValueGender = document.querySelector(".currentDataGender");
    
    const fileInput = document.getElementById("file-input");
    const photo = document.querySelector(".bottom-image");
    photo.style.display = "block";

    photo.addEventListener("click", function () {
        fileInput.click();
    });
    
    

    defaultValueGender.parentNode.removeChild(defaultValueGender);
    defaultValues.remove();
    defaultValueNickname.remove();
    defaultValueBirthdate.remove();
    
}

function getData() {
    const newGender = document.querySelector("#gender").value;
    const newName = document.querySelector("#new-name").value;
    const interests = document.querySelector("#interests").value;
    const birthdate = document.querySelector("#birthdate").value;
    const userId = document.querySelector("#user_id").value;

    const fileInput = document.getElementById("file-input");
    const file = fileInput.files[0];
    
    const data = new FormData();
    data.append("user_id", userId);
    data.append("gender", newGender);
    data.append("name", newName);
    data.append("interests", interests);
    data.append("birthdate", birthdate);
    data.append("image", file);
    sendData(data);
}
function sendData(data) {
    var csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    fetch("/user/profile", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
        body: data,
    })
        .then((response) => {
            if (response.status === 200) {
                console.log("Успешно");
            } else {
                console.error("Ошибка сервера");
            }
        })
        .catch((error) => {
            console.error(error);
        });
}
