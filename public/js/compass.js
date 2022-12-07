document.addEventListener('DOMContentLoaded', async function(){
  const questions = await fun();
  questionsnum = await num();
  const buttons = [...document.querySelectorAll('.next, .buttons button, .checkboxes button')];
  const ranges = [...document.querySelectorAll('.next')];
  var questionAnswer = [];
  var currentQuestion = 0;
  const span = document.querySelector('.current_question');
  buttons.forEach(element => {
      element.addEventListener('click', function(){
          if(element.getAttribute("name") == "next")
              if(questionAnswer.length == 0) 
                  value = document.querySelector('.range > input[type="range"]').value;
              else 
                  value = document.querySelector('.range2 > input[type="range"]').value;
          else {
              value = element.value;
          }

          if (questionAnswer.length < questionsnum) {
              questionAnswer.push(value);
          }
          if (questionAnswer.length >= questionsnum) {
              document.querySelector('input[type="hidden"]').value = questionAnswer.join(',');
              document.querySelector('form').submit();
              return;
          }

          if (currentQuestion >= 0) {
              document.querySelector(".prev").style.display = "inline-block";
          }
          const span = document.querySelector('.current_question');
          const id = span.innerHTML.trim();
          
          currentQuestion++;
          span.innerHTML = currentQuestion + 1;

          document.querySelector('.current_title').innerHTML = questions[currentQuestion].description;

          type = questions[currentQuestion].type;
          document.querySelector(".buttons").style.display = "none";
          document.querySelector(".range").style.display = "none";
          document.querySelector(".range2").style.display = "none";
          document.querySelector(".checkboxes").style.display = "none";
          document.querySelector("."+type).style.display = "block";
          document.querySelector(".next").style.display = "none";
          if (type == "range" || type == "range2") {
            document.querySelector(".next").style.display = "inline-block";
          } else if (type == "buttons") {
            document.querySelector("."+type).style.display = "flex";
          }
      })
  })  
  document.querySelector(".prev").addEventListener('click', function(){
      questionAnswer.pop();
      currentQuestion--;
      span.innerHTML = currentQuestion + 1;
      document.querySelector('.current_title').innerHTML = questions[currentQuestion].description;

      type = questions[currentQuestion].type;
      document.querySelector(".buttons").style.display = "none";
      document.querySelector(".range").style.display = "none";
      document.querySelector(".range2").style.display = "none";
      document.querySelector(".checkboxes").style.display = "none";
      document.querySelector(".next").style.display = "none";
      document.querySelector("."+type).style.display = "block";
      if (type != "buttons") {
        document.querySelector(".next").style.display = "inline-block";
      } else {
        document.querySelector("."+type).style.display = "flex";
      }

      if (currentQuestion <= 0) {
          document.querySelector(".prev").style.display = "none";
      }

      const range = document.querySelector(".range1, .range2");
      const bubble = document.querySelector(".output");
      setBubble(range, bubble);
      
  });
}
)
async function fun(){
  const data = await fetch("/questions", {
  method: "POST",
  })  
  .then(response => response.json())
  return data;
}
async function num(){
  const data = await fetch("/questionsnum", {
  method: "POST",
  })  
  .then(response => response.json())
  return data;
}
function changeButtonType(buttons){
  buttons.forEach(button => button.type = 'submit');
}

for (let e of document.querySelectorAll('input[type="range"].slider-progress')) {
    e.style.setProperty('--value', e.value);
    e.style.setProperty('--min', e.min == '' ? '0' : e.min);
    e.style.setProperty('--max', e.max == '' ? '100' : e.max);
    e.addEventListener('input', () => e.style.setProperty('--value', e.value));
}
const allRanges = document.querySelectorAll(".range, .range2");
allRanges.forEach(wrap => {
  const range = wrap.querySelector(".range1, .range2");
  const bubble = wrap.querySelector(".output");

  range.addEventListener("input", () => {
    setBubble(range, bubble);
  });
  setBubble(range, bubble);
});

function setBubble(range, bubble) {
  const val = range.value;
  const min = range.min ? range.min : 1000;
  const max = range.max ? range.max : 5500;
  const newVal = Number(((val - min) * 100) / (max - min));
  bubble.innerHTML = val;

  margin = 40.9;
  if (max != 118)
    margin = 41.2;

  // Sorta magic numbers based on size of the native UI thumb
  bubble.style.left = `calc(${newVal}% + (${margin - newVal * 0.853}vw))`;
  bubble.style.background = 'rgba(255, 255, 255, 0.2)'

  range.style.width = newVal + '% 100% !important';
}