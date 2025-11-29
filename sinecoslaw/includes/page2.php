<?php require_once("functions.php"); ?>
<?php
    $choice = mt_rand(0,5);
    if($choice == 0)
        $prob = Number1();
    else if($choice == 1)
        $prob = Number2();
    else if($choice == 2)
        $prob = Tickets();
    else if($choice == 3)
        $prob = Current1();
    else if($choice == 4)
        $prob = Fruits();
    else
        $prob = Current2();

    echo '<fieldset style="margin-bottom:10px;">
        <legend><strong>Mode:</strong></legend>
            <label style = " display: inline;">
                <input type="radio" name="mode" value="practice" id="modePractice" checked style = " display: inline;">
                    Practice mode
            </label>
            &nbsp;&nbsp;
            <label style = " display: inline;">
                <input type="radio" name="mode" value="challenge" id="modeChallenge" style = " display: inline;">
                    Challenge mode
            </label>
            </fieldset>';

    echo "<h5><strong>Example</strong> <a href = 'sinecoslaw.php?page=2'><img src = '..\images\change.png' width = '60px'></a></h5> ".$prob[0]."<br><br><h5>
    
    <!-- Controls -->
<button id='toggleButton' onclick='toggleSolution()' aria-expanded='false'>Show Solution</button>

<!-- Challenge area (hidden by default, shown only in Challenge mode) -->
<div id='challengeArea' style='display:none; margin-top:10px;'>
  <label for='userAnswer'><strong>Your answer:</strong></label>
  <input type='text' id='userAnswer' style='margin-left:8px; min-width:240px;' autocomplete='off'>
  <button id='submitAnswerBtn' style='margin-left:8px;'>Submit</button>
  <span id='answerStatus' style='margin-left:10px;font-size:0.95em;'></span>
</div>

    <div id='solution' style='display:none; margin-top:10px;'>
    
    <h5><strong>Solution</strong></h5>
    
    <p>".$prob[1]."</p>
    
</div>
    
<script>
// Grab elements
const toggleBtn = document.getElementById('toggleButton');
const solutionEl = document.getElementById('solution');
const challengeArea = document.getElementById('challengeArea');
const modePractice = document.getElementById('modePractice');
const modeChallenge = document.getElementById('modeChallenge');
const userAnswer = document.getElementById('userAnswer');
const submitAnswerBtn = document.getElementById('submitAnswerBtn');
const answerStatus = document.getElementById('answerStatus');

// --------------- Initial State ---------------
initUI();

function initUI() {
  // Default: Practice mode, solution hidden, Show Solution enabled
  solutionEl.style.display = 'none';
  toggleBtn.disabled = false;
  toggleBtn.textContent = 'Show Solution';
  toggleBtn.setAttribute('aria-expanded', 'false');
  challengeArea.style.display = 'none';
  answerStatus.textContent = '';
  userAnswer.value = '';

  // Listeners
  modePractice.addEventListener('change', handleModeChange);
  modeChallenge.addEventListener('change', handleModeChange);
  submitAnswerBtn.addEventListener('click', onSubmitAnswer);
}

// --------------- Mode Handling ---------------
// Handle switching between Practice and Challenge
function handleModeChange() {
  solutionEl.style.display = 'none';
  toggleBtn.textContent = 'Show Solution';
  toggleBtn.setAttribute('aria-expanded', 'false');
  answerStatus.textContent = '';
  userAnswer.value = '';

  if (modePractice.checked) {
    challengeArea.style.display = 'none';
    toggleBtn.style.display = 'inline-block'; // visible
  } else {
    challengeArea.style.display = 'block';
    toggleBtn.style.display = 'none'; // hidden until Submit
    userAnswer.focus();
  }
}

// Handle submit in Challenge mode
function onSubmitAnswer(e) {
  e.preventDefault();
  if (!modeChallenge.checked) return;

  const val = (userAnswer.value || '').trim();
  if (val.length === 0) {
    answerStatus.textContent = 'Please type an answer before submitting.';
    return;
  }

  // You could check correctness here if desired
  answerStatus.textContent = 'Answer recorded. You may now view the solution.';
  toggleBtn.style.display = 'inline-block'; // show Show Solution button
}


// Toggle solution visibility
function toggleSolution() {
  const isHidden = solutionEl.style.display === 'none';
  solutionEl.style.display = isHidden ? 'block' : 'none';
  toggleBtn.textContent = isHidden ? 'Hide Solution' : 'Show Solution';
  toggleBtn.setAttribute('aria-expanded', String(isHidden));
}
</script>
";

?>