

document.addEventListener('DOMContentLoaded', function () {

    const createTaskForm = document.querySelector('.task-form');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    createTaskForm.addEventListener('submit', (e) => {

        e.preventDefault();

        const taskInput = createTaskForm.querySelector('.task-form__input');

        fetch('/addTask', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'x-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({
                taskText: taskInput.value,

            })
        })
            .then(response => response.json())
            .then(data =>{
                if(data.success) {
                    const taskElement = document.createElement('div');
                    taskElement.classList.add('task-card');
                    taskElement.classList.add('task-card--todo');
                    taskElement.innerHTML =
                        `<a href="task/${data.task.id}" class="task-link">
                         <p class="task-card__status">${data.task.status}</p>
                         <p class="task-card__description">${data.task.text}</p>
                         <p class="task-card__date">${data.task.date}</p>
                         </a>
                        <div class="task-card__btn-container">
                            <form class="task-card__form">
                                <button class="task-card__action" name="MarkAsDone" id="${data.task.id}">Mark as done</button>
                            </form>
                            <div class="task-card__delete-form">
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="task-card__delete delete-button" name="DeleteTheTask" data-id="${data.task.id}" data-csrf="${csrfToken}">Delete the task</button>
                            </div>
                        </div>`;

                    const taskContainer = document.querySelector('.task-cards');
                    taskInput.value = "";
                    taskContainer.appendChild(taskElement);

                } else {
                    alert(data.message);
                }
            })

    });

});
