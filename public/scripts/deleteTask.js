

document.addEventListener('DOMContentLoaded', function () {

    const buttons = document.querySelectorAll('.delete-button');

    buttons.forEach(button => {

        button.addEventListener('click', (e)=>{

            const taskId = e.target.getAttribute('data-id');
            const csrf = e.target.getAttribute('data-csrf');
            const taskCard = e.target.closest('.task-card');

            if(confirm('Вы уверены, что хотите удалить задачу?')){
                fetch(`/deleteTask/${taskId}`, {
                    method: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'Content-Type': 'application/json'
                    }
                })
                    .then(response =>response.json())
                    .then(data =>{
                        if (data.success){
                            taskCard.remove();
                        }else {
                            alert('Ошибка' + data.message);
                        }
                    })
                    .catch(e =>{
                        console.error('Error', e);
                        alert('Произошла ошибка!');
                    })
            }
        });
    });
});
