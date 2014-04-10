/* Elements */
var addStrokeButton = $('#add-stroke');
var finishHoleButton = $("#finish-hole");
var holeScoreView = $('#holescore')[0];
var totalScoreView = $('#totalscore')[0];

var holeScore = 0;
var totalScore = 0;

addStrokeButton[0].addEventListener('click', function(event) {
  addStroke();
  event.preventDefault();
}, false);


function addStroke() {
  console.log(["holeScore", holeScoreView.innerHTML]);
  console.log(["totalScore", totalScoreView.innerHTML]);
  holeScoreView.innerHTML = parseInt(holeScoreView.innerHTML, 10) + 1;
}