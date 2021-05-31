const coursecode = [
    {name: 'COMP202'}, {name: 'COMP206'}, {name: 'COMP250'}, {name: 'COMP251'}, {name: 'COMP303'}
];

const searchInput = document.querySelector('.searchinput');
const suggestionsPanel = document.querySelector('.suggestions');


searchInput.addEventListener('keyup', function(){
    const input = searchInput.value;

    suggestionsPanel.innerHTML='';

    //filter method creates the array with new elements. 
    const suggestions = coursecode.filter(function(course){
        return course.name.toLowerCase().startsWith(input);
    })

    suggestions.forEach(function(suggested){
        const div = document.createElement('div');
        div.innerHTML = suggested.name;
        suggestionsPanel.appendChild(div);
    })

    if (input==''){
        suggestionsPanel.innerHTML = '';
    }
})

