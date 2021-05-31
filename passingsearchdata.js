function handleSearch (){
    //get the input value from the search bar
    const coursename = document.getElementById('Course_name').value;
    localStorage.setItem("COURSENAME", coursename);
    document.getElementById("searchform").submit();
    return false;
}