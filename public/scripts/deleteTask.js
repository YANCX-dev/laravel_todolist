
document.addEventListener('DOMContentLoaded', function () {

    const formContainer = document.querySelector('.task-card__delete-form');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    document.addEventListener('click', (e)=>{
        if(!e.target.matches('button.delete-button')){
            return
        }
        const taskId = e.target.getAttribute('data-id');
        const taskCard = e.target.closest('.task-card');

        if(confirm('Вы уверены, что хотите удалить задачу?')){
            fetch(`/deleteTask/${taskId}`, {
                method: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
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
    })

});
