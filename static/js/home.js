$(function(){
  $(window).bind('load resize', mainVisualLoad);
});

var currentModeIsSP = null;
var mainVisualLoadInterval = null;
var mainVisualLoad = function(){
  var isSP = function () {
    return window.matchMedia('(max-width:640px)').matches;
  };
  if(currentModeIsSP === isSP()) {
    return false;
  }
  var targetLoadingElement = '.m-topSlider_loading';
  var targetInnerElement = '.m-topSlider_inner';
  var targetUnitElement = '.m-topSlider_unit';
  var moveLeftElement = '.m-topSlider_moveLeft';
  var moveRightElement = '.m-topSlider_moveRight';
  var topDiff = leftDiff = isSP() ? 130 : 260;
  var movePxPerSec = 40;
  var elementCount = $(targetUnitElement).size();
  var reverse = false;
  var i = 1;

  clearInterval(mainVisualLoadInterval);
  currentModeIsSP = isSP();
  $(targetLoadingElement).stop(true, true).show(0);
  $(targetInnerElement).stop(true, true).hide(0);
  $(targetUnitElement + ' img').lazyload({
    event: 'load'
  }); // autoload img
  var distributeUnit = function(){
    var topPos = topStartPos = isSP() ? 20 : 30;
    var leftPos = leftStartPos = leftDiff * -1;
    $(targetUnitElement).each(function(){
      $(this).css({
        'top': topPos + 'px',
        'left': leftPos + 'px'
      });
      if(i % 2 === 0) {
        topPos = topStartPos;
        leftPos += leftDiff;
      } else {
        topPos += topDiff;
      }
      i++;
    });
  };
  distributeUnit();
  var animationLoop = function(){
    $(targetInnerElement).finish();
    var moveCount = 2;
    var animation = reverse ? {
      'left': leftDiff + 'px'
    } : {
      'left': '-' + leftDiff + 'px'
    };
    $(targetInnerElement).animate(animation, leftDiff / movePxPerSec * 1000, 'linear', function(){
      if(reverse) {
        $(targetInnerElement).prepend($(targetUnitElement + ':gt(-' + (moveCount + 1) + ')'));
      } else {
        $(targetInnerElement).append($(targetUnitElement + ':lt(' + moveCount + ')'));
      }
      $(targetInnerElement).css('left', 0);
      distributeUnit();
    });
  };
  $(targetLoadingElement).fadeOut(1000, function(){
    $(targetInnerElement).fadeIn(1000);
    animationLoop();
    mainVisualLoadInterval = setInterval(animationLoop, leftDiff / movePxPerSec * 1000);
  });

  // move button setting
  $(moveLeftElement).bind('touchstart', function(){
    movePxPerSec = 100;
    clearInterval(mainVisualLoadInterval);
    animationLoop();
    mainVisualLoadInterval = setInterval(animationLoop, leftDiff / movePxPerSec * 1000);
  });
  $(moveLeftElement).bind('touchend', function(){
    movePxPerSec = 40;
    clearInterval(mainVisualLoadInterval);
    animationLoop();
    mainVisualLoadInterval = setInterval(animationLoop, leftDiff / movePxPerSec * 1000);
  });
  $(moveLeftElement).bind('click', function(){
    // avoid click event in smartphone
    if(typeof window.ontouchstart !== 'undefined') {
      return;
    }
    clearInterval(mainVisualLoadInterval);
    animationLoop();
    animationLoop();
    mainVisualLoadInterval = setInterval(animationLoop, leftDiff / movePxPerSec * 1000);
  });
  $(moveRightElement).bind('touchstart', function(){
    movePxPerSec = 100;
    reverse = true;
    clearInterval(mainVisualLoadInterval);
    animationLoop();
    mainVisualLoadInterval = setInterval(animationLoop, leftDiff / movePxPerSec * 1000);
  });
  $(moveRightElement).bind('touchend', function(){
    animationLoop();
    movePxPerSec = 40;
    reverse = false;
    clearInterval(mainVisualLoadInterval);
    animationLoop();
    mainVisualLoadInterval = setInterval(animationLoop, leftDiff / movePxPerSec * 1000);
  });
  $(moveRightElement).bind('click', function(){
    // avoid click event in smartphone
    if(typeof window.ontouchstart !== 'undefined') {
      return;
    }
    reverse = true;
    clearInterval(mainVisualLoadInterval);
    animationLoop();
    $(targetInnerElement).finish();
    reverse = false;
    animationLoop();
    mainVisualLoadInterval = setInterval(animationLoop, leftDiff / movePxPerSec * 1000);
  });
};
