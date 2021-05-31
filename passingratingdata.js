window.addEventListener('load', () => {
    const coursename = localStorage.getItem('COURSENAME');
    document.getElementById('course_code').innerHTML = coursename;
})