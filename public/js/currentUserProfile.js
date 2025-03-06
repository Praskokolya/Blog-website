function showAllForms() {
    showForms();
    removeDeleteButton();
    showUpdateButton();
    setPhoto();
    removeDefaultValues();
    deleteClickHandler();
}

function showForms() {
    const allForms = document.querySelectorAll("form");
    allForms.forEach((form) => {
        form.style.display = "block";
    });
}

function removeDeleteButton() {
    const buttonWhichWillBeDeleted = document.getElementById("buttonDelete");
    buttonWhichWillBeDeleted.remove();
}

function showUpdateButton() {
    const buttonShowUpdate = document.querySelector(".hiddenbtn");
    const buttonShowDelete = document.querySelector(".bottom-image-delete");
    buttonShowUpdate.style.display = "block";
    buttonShowDelete.style.display = "block";
}

function setPhoto() {
    const fileInput = document.getElementById("file-input");
    const photo = document.querySelector(".bottom-image");
    photo.style.display = "block";

    photo.addEventListener("click", function () {
        fileInput.click();
    });
}

function removeDefaultValues() {
    const defaultValueGender = document.querySelector(".currentDataGender");
    const defaultValues = document.querySelector(".currentDataInterests");
    const defaultValueNickname = document.querySelector(".currentDataNickname");
    const defaultValueBirthdate = document.querySelector(
        ".currentDataBirthdate"
    );

    defaultValueGender.parentNode.removeChild(defaultValueGender);
    defaultValues.remove();
    defaultValueNickname.remove();
    defaultValueBirthdate.remove();
}

function deleteClickHandler() {
    const buttonShowDelete = document.querySelector(".bottom-image-delete");
    buttonShowDelete.addEventListener("click", function () {
        sendDeleteRequest();
    });
}

function sendDeleteRequest() {
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    fetch("/user/profile", {
        method: "DELETE",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
    })
        .then((response) => {
            if (response.status === 200) {
                console.log("Image deleted");
            } else {
                console.error("Errro");
            }
        })
        .catch((error) => {
            console.error(error);
        });
        setTimeout(function () {
            window.location.href = '/user/profile';
          }, 100);

}

function getData() {
    const newGender = document.querySelector("#gender").value;
    const newName = document.querySelector("#new-name").value;
    const interests = document.querySelector("#interests").value;
    const birthdate = document.querySelector("#birthdate").value;

    const fileInput = document.getElementById("file-input");
    const file = fileInput.files[0];

    const data = new FormData();
    data.append("gender", newGender);
    data.append("nickname", newName);
    data.append("interests", interests);
    data.append("birthdate", birthdate);
    data.append("image", file);

    sendData(data);
}

function sendData(data) {
    const csrfToken = document
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
                console.log("Successful");
            } else {
                console.error("ПОМИЛКА!");
            }
        })
        .catch((error) => {
            console.error(error);
        });
        setTimeout(function () {
            window.location.href = '/user/profile';
          }, 100);
}
