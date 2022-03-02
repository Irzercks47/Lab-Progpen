var arr = []

arr.push(document.getElementById('csv'))
arr.push(document.getElementById('hex'))
arr.push(document.getElementById('compile'))

var type = document.createElement("input")
type.type = "hidden"
type.value = "none"
type.name = "type"
type.classList.add("custom-input")

var header = document.getElementById('with-header')
var exec = document.getElementById("exec-type")

var form = document.getElementById('uploader-form')

for (let index = 0; index < arr.length; index++) {
    arr[index].addEventListener("click",() => {
        for(let i = 0; i < arr.length; i++){
            if(i == index) {
                
                if(arr[i].id === 'csv' && !header.classList.contains('display-it')){
                    exec.classList.remove('display-it')
                    header.classList.toggle('display-it')
                } else if (arr[i].id !== 'csv' && header.classList.contains('display-it')) {
                    header.classList.remove('display-it')
                }

                if(arr[i].id === 'compile' && !exec.classList.contains('display-it')){
                    header.classList.remove('display-it')
                    exec.classList.toggle('display-it')
                } else if (arr[i].id !== 'compile' && exec.classList.contains('display-it')) {
                    exec.classList.remove('display-it')
                }

                arr[i].classList.add('bg-blue-500')
                arr[i].classList.remove("border-blue-300")
                arr[i].value = arr[i].id

                // console.log(form.children[3])

                if(form.children[3] !== undefined && form.children[3].classList.contains("custom-input")){
                    form.removeChild(type)
                }

                type.value = arr[i].id
                
                form.appendChild(type)
                continue
            }
            arr[i].classList.remove("bg-blue-500")
            arr[i].classList.add("border-blue-300")
            arr[i].value = ""
        }
    })
}

var cpp = document.getElementById('cpp')
var python = document.getElementById('python')

cpp.addEventListener('click',() => {
    python.checked = false
})

python.addEventListener('click', () => {
    cpp.checked = false
})