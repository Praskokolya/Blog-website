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

function sendData(){
    const select = document.querySelector('#gender');

    // Получаем значение поля select
    const gender = select.value;
    
    // Выводим значение в консоль
    console.log(gender);
}
