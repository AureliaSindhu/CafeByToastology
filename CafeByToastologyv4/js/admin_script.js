function saveDataToLocalStorage(key, value) {
    localStorage.setItem(key, JSON.stringify(value));
}

function getDataFromLocalStorage(key) {
    const data = localStorage.getItem(key);
    return data ? JSON.parse(data) : null;
}

document.addEventListener('DOMContentLoaded', () => {
    const adminId = admin; 
    saveDataToLocalStorage('adminId', adminId);

    const storedAdminId = getDataFromLocalStorage('adminId');
    if (storedAdminId) {
        console.log('Admin ID:', storedAdminId);
    } else {
        console.log('Admin ID not found in local storage.');
    }
});

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
    profile.classList.remove('active');
}

document.querySelector('#user-btn').onclick = () =>{
    profile.classList.toggle('active');
    navbar.classList.remove('active');
}

window.onscroll = () =>{
    navbar.classList.remove('active');
    profile.classList.remove('active');
}
