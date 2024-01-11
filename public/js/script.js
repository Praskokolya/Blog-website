function ShowResponseInput(id) {
    var postContainer = document.getElementById(id);
    var inputGroupDiv = postContainer.querySelector("#form");
    inputGroupDiv.style.display = "block";
    var Response = inputGroupDiv.value;

    if (Response !== "") {
        var csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        var data = new FormData();
        data.append("response", Response);
        data.append("contact_id", id);

        fetch("create-response", {
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
    }
}
