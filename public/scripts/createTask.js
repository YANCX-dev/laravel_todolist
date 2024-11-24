

document.addEventListener('DOMContentLoaded', function () {

    const createTaskForm = document.querySelector('.task-form');

    createTaskForm.addEventListener('submit', (e) => {

        e.preventDefault();

        const taskText = createTaskForm.querySelector('.task-form__input').value;

        fetch('/addTask', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'x-CSRF-TOKEN': e.target.getAttribute('data-csrf'),
            },
            body: JSON.stringify({
                taskText: taskText,

            })
        })
            .then(response => response.json())
            .then(data =>{
                console.log(data);
                if(data.success) {

                    const taskElement = document.createElement('div');
                    let statusStr = toString(data.task.status);
                    taskElement.classList.add('task-card');
                    // taskElement.classList.add(`task-card--${statusStr.toLowerCase()}`);
                    console.log(toString(data));
                    taskElement.innerHTML =
                        `<p class="task-card__status">${data.task.status}</p>
                         <p class="task-card__description">${data.task.text}</p>
                         <p class="task-card__date">${data.task.date}</p>
                        <div class="task-card__btn-container">
                            <form class="task-card__form">
                                <button class="task-card__action" name="MarkAsDone" id="${data.task.id}">Mark as done</button>
                            </form>
                            <div class="task-card__delete-form">
                                @method("DELETE")
                                <button class="task-card__delete delete-button" name="DeleteTheTask" data-id="${data.task.id}" data-csrf="${e.target.getAttribute('data-csrf')}">Delete the task</button>
                            </div>
                        </div>`;

                    const taskContainer = document.querySelector('.task-cards');
                    taskContainer.appendChild(taskElement);

                }
            })

    });

});
