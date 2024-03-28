let currentQuestionIndex = 0;
let answersubmitted = false;

const questionsContainer = document.getElementById("question-container");
const nextQuestionButton = document.getElementById("next-question");

const wrongQuestions = [];

function displayQuestion(index) {
    answersubmitted = false;
    const question = questions[index];

    if (question) {
        questionsContainer.innerHTML = `<p>${question.content}</p><div class="answers" data-question-id="${question.id}"></div>`;
        nextQuestionButton.style.display = "none";

        fetchAnswers(question.id);
    }
}

function displayQuestionWrongQuestions(index) {
    answersubmitted = false;
    const questionId = wrongQuestions[index];
    wrongQuestions.splice(index, 1);
    const question = questions.find((question) => question.id == questionId);

    if (question) {
        questionsContainer.innerHTML = `<p>${question.content}</p><div class="answers" data-question-id="${question.id}"></div>`;
        nextQuestionButton.style.display = "none";

        fetchAnswers(question.id);
    }
}

function displayQuestion(index) {
    if (index < questions.length) {
        const question = questions[index];
        questionsContainer.innerHTML = `<p>${question.content}</p><div class="answers" data-question-id="${question.id}"></div>`;
        nextQuestionButton.style.display = "none";

        fetchAnswers(question.id);
    }
}

function fetchAnswers(questionId) {
    fetch("/fetch-answers", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ questionId: questionId }),
    })
        .then((response) => response.json())
        .then((data) => {
            const answersContainer = questionsContainer.querySelector(
                `.answers[data-question-id="${questionId}"]`
            );
            answersContainer.innerHTML = data.answers
                .map((answer) => {
                    return `<button  class="answer-button bg-blue-500 text-white p-2 m-2 rounded answer-button hover:bg-blue-700" data-answer-id="${answer.id}">${answer.content}</button>`;
                })
                .join("");
        });
}
function checkAnswer(questionId, answerId) {
    if (answersubmitted) return;
    fetch("/validate-answer", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ questionId: questionId, answerId: answerId }),
    })
        .then((response) => response.json())
        .then((data) => {
            const answersContainer = questionsContainer.querySelector(
                `.answers[data-question-id="${questionId}"]`
            );
            answersContainer
                .querySelectorAll(".answer-button")
                .forEach((button) => {
                    // Retirer les classes existantes pour réinitialiser le style des boutons
                    button.classList.remove("bg-red-500", "bg-green-500");

                    if (button.dataset.answerId === answerId) {
                        // Appliquer la classe bg-red-500 de Tailwind si la réponse est incorrecte
                        button.classList.add(
                            data.correct ? "bg-green-500" : "bg-red-500",
                            data.correct
                                ? "hover:bg-green-700"
                                : "hover:bg-red-700"
                        );
                    }

                    if (button.dataset.answerId == data.correctAnswerId) {
                        // Appliquer la classe bg-green-500 de Tailwind si c'est la bonne réponse
                        button.classList.add(
                            "bg-green-500",
                            "hover:bg-green-700"
                        );
                    }
                });

            if (!data.correct) {
                wrongQuestions.push(questionId);
            }
            answersubmitted = true;
            nextQuestionButton.style.display = "block";
        });
}

questionsContainer.addEventListener("click", function (event) {
    const target = event.target;
    if (target.classList.contains("answer-button")) {
        const questionId = target.parentElement.dataset.questionId;
        const answerId = target.dataset.answerId;
        checkAnswer(questionId, answerId);
    }
});

nextQuestionButton.addEventListener("click", function () {
    currentQuestionIndex++;
    if (currentQuestionIndex < questions.length) {
        displayQuestion(currentQuestionIndex);
    } else {
        if (wrongQuestions.length > 0) {
            console.log(wrongQuestions);
            displayQuestionWrongQuestions(0);
        } else {
            nextQuestionButton.style.display = "none";
            questionsContainer.innerHTML =
                "<h1>Bravo, vous avez terminé le test !</h1>";

            fetch("/update-progress", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ lessonId: lessonId }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        questionsContainer.innerHTML +=
                            `<p>Votre progression a été mise à jour !</p>
                            <a class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href='/learn'>Retourner à la liste des leçons</a>`;
                    }
                })
                .catch((error) => {
                    console.error(error);
                });
        }
    }
});

displayQuestion(currentQuestionIndex);
