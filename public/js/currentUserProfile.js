
function showAllForms(){
    allForms = document.querySelectorAll('form');
    allFormsData = allForms.forEach(form => {
        form.style.display = 'block';
    });
    
    buttonWhichWillBeDeleted = document.getElementById('buttonDelete');
    buttonWhichWillBeDeleted.remove();

    buttonWillBeShow = document.querySelector('.hiddenbtn');
    buttonWillBeShow.style.display = 'block'
 
    const defaultValues = document.querySelector('.currentDataInterests');
    const defaultValueNickname = document.querySelector('.currentDataNickname');
    const defaultValueBirthdate = document.querySelector('.currentDataBirthdate');
    const defaultValueGender = document.querySelector('.currentDataGender');
    
    defaultValueGender.parentNode.removeChild(defaultValueGender);
    defaultValues.remove()
    defaultValueNickname.remove()
    defaultValueBirthdate.remove()

}

function getData(){
    const newGender = document.querySelector('#gender').value;
    const newName = document.querySelector('#new-name').value;
    const interests = document.querySelector('#interests').value;
    const birthdate = document.querySelector('#birthdate').value;
    const userId = document.querySelector('#user_id').value;

    const data = {
        user_id: userId,
        gender: newGender,
        name: newName,
        interests: interests,
        birthdate: birthdate
      };
    sendData(data)
}

function sendData(data) {
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/user/profile', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
    },
    body: JSON.stringify({
        data 
    })
})
.then(response => {
    if (response.status === 200) {
        console.log(data, 'all right')
    } else {
        console.error('Ошибка сервера');
    }
})
.catch(error => {
    console.error(error);
});
  }
  
