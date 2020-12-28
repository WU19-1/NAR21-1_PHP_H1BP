var data = document.getElementsByClassName("data")

var clicked = []

for (let index = 0; index < data.length; index++) {
    data[index].addEventListener('click',() => {
        if(!clicked[index]){
            data[index].type = "hidden"
            
            var textArea = document.createElement("textarea")
            textArea.innerHTML = data[index].value
            // data[index].innerHTML = ""
            // data[index].appendChild(textArea);
            data[index].parentNode.appendChild(textArea)
            clicked[index] = true
            textArea.addEventListener('blur',() => {
                // data[index].innerHTML = textArea.value
                data[index].type = "text"
                data[index].value = textArea.value
                textArea.remove()
                clicked[index] = false
            })
            textArea.focus()
        }
    })
}