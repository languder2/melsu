(function() {
    var SwipeContent = function(element) {
    this.element = element;
    this.delta = [false, false];
    this.dragging = false;
    this.intervalId = false;
    initSwipeContent(this);
};

    function initSwipeContent(content) {
    content.element.addEventListener('mousedown', handleEvent.bind(content));
    content.element.addEventListener('touchstart', handleEvent.bind(content));
};

    function initDragging(content) {
    content.element.addEventListener('mousemove', handleEvent.bind(content));
    content.element.addEventListener('touchmove', handleEvent.bind(content));
    content.element.addEventListener('mouseup', handleEvent.bind(content));
    content.element.addEventListener('mouseleave', handleEvent.bind(content));
    content.element.addEventListener('touchend', handleEvent.bind(content));
};

    function cancelDragging(content) {
    if(content.intervalId) {
    (!window.requestAnimationFrame) ? clearInterval(content.intervalId) : window.cancelAnimationFrame(content.intervalId);
    content.intervalId = false;
}
    content.element.removeEventListener('mousemove', handleEvent.bind(content));
    content.element.removeEventListener('touchmove', handleEvent.bind(content));
    content.element.removeEventListener('mouseup', handleEvent.bind(content));
    content.element.removeEventListener('mouseleave', handleEvent.bind(content));
    content.element.removeEventListener('touchend', handleEvent.bind(content));
};

    function handleEvent(event) {
    switch(event.type) {
    case 'mousedown':
    case 'touchstart':
    startDrag(this, event);
    break;
    case 'mousemove':
    case 'touchmove':
    drag(this, event);
    break;
    case 'mouseup':
    case 'mouseleave':
    case 'touchend':
    endDrag(this, event);
    break;
}
};

    function startDrag(content, event) {
    content.dragging = true;
    initDragging(content);
    content.delta = [parseInt(unify(event).clientX), parseInt(unify(event).clientY)];
    emitSwipeEvents(content, 'dragStart', content.delta);
};

    function endDrag(content, event) {
    cancelDragging(content);
    var dx = parseInt(unify(event).clientX),
    dy = parseInt(unify(event).clientY);

    if(content.delta && (content.delta[0] || content.delta[0] === 0)) {
    var s = Math.sign(dx - content.delta[0]);

    if(Math.abs(dx - content.delta[0]) > 30) {
    (s < 0) ? emitSwipeEvents(content, 'swipeLeft', [dx, dy]) : emitSwipeEvents(content, 'swipeRight', [dx, dy]);
}

    content.delta[0] = false;
}
    if(content.delta && (content.delta[1] || content.delta[1] === 0)) {
    var y = Math.sign(dy - content.delta[1]);

    if(Math.abs(dy - content.delta[1]) > 30) {
    (y < 0) ? emitSwipeEvents(content, 'swipeUp', [dx, dy]) : emitSwipeEvents(content, 'swipeDown', [dx, dy]);
}

    content.delta[1] = false;
}
    emitSwipeEvents(content, 'dragEnd', [dx, dy]);
    content.dragging = false;
};

    function drag(content, event) {
    if(!content.dragging) return;
    (!window.requestAnimationFrame)
    ? content.intervalId = setTimeout(function(){emitDrag.bind(content, event);}, 250)
    : content.intervalId = window.requestAnimationFrame(emitDrag.bind(content, event));
};

    function emitDrag(event) {
    emitSwipeEvents(this, 'dragging', [parseInt(unify(event).clientX), parseInt(unify(event).clientY)]);
};

    function unify(event) {
    return event.changedTouches ? event.changedTouches[0] : event;
};

    function emitSwipeEvents(content, eventName, detail) {
    var event = new CustomEvent(eventName, {detail: {x: detail[0], y: detail[1]}});
    content.element.dispatchEvent(event);
};

    window.SwipeContent = SwipeContent;

    var swipe = document.getElementsByClassName('js-swipe-content');
    if( swipe.length > 0 ) {
    for( var i = 0; i < swipe.length; i++) {
    (function(i){new SwipeContent(swipe[i]);})(i);
}
}
}());

    function Util () {};

    Util.hasClass = function(el, className) {
    if (el.classList) return el.classList.contains(className);
    else return !!el.className.match(new RegExp('(\\s|^)' + className + '(\\s|$)'));
};

    Util.addClass = function(el, className) {
    var classList = className.split(' ');
    if (el.classList) el.classList.add(classList[0]);
    else if (!Util.hasClass(el, classList[0])) el.className += " " + classList[0];
    if (classList.length > 1) Util.addClass(el, classList.slice(1).join(' '));
};

    Util.removeClass = function(el, className) {
    var classList = className.split(' ');
    if (el.classList) el.classList.remove(classList[0]);
    else if(Util.hasClass(el, classList[0])) {
    var reg = new RegExp('(\\s|^)' + classList[0] + '(\\s|$)');
    el.className=el.className.replace(reg, ' ');
}
    if (classList.length > 1) Util.removeClass(el, classList.slice(1).join(' '));
};

    Util.toggleClass = function(el, className, bool) {
    if(bool) Util.addClass(el, className);
    else Util.removeClass(el, className);
};

    Util.setAttributes = function(el, attrs) {
    for(var key in attrs) {
    el.setAttribute(key, attrs[key]);
}
};


    Util.getChildrenByClassName = function(el, className) {
    var children = el.children,
    childrenByClass = [];
    for (var i = 0; i < el.children.length; i++) {
    if (Util.hasClass(el.children[i], className)) childrenByClass.push(el.children[i]);
}
    return childrenByClass;
};

    Util.setHeight = function(start, to, element, duration, cb) {
    var change = to - start,
    currentTime = null;

    var animateHeight = function(timestamp){
    if (!currentTime) currentTime = timestamp;
    var progress = timestamp - currentTime;
    var val = parseInt((progress/duration)*change + start);
    element.setAttribute("style", "height:"+val+"px;");
    if(progress < duration) {
    window.requestAnimationFrame(animateHeight);
} else {
    cb();
}
};

    element.setAttribute("style", "height:"+start+"px;");
    window.requestAnimationFrame(animateHeight);
};


    Util.scrollTo = function(final, duration, cb) {
    var start = window.scrollY || document.documentElement.scrollTop,
    currentTime = null;

    var animateScroll = function(timestamp){
    if (!currentTime) currentTime = timestamp;
    var progress = timestamp - currentTime;
    if(progress > duration) progress = duration;
    var val = Math.easeInOutQuad(progress, start, final-start, duration);
    window.scrollTo(0, val);
    if(progress < duration) {
    window.requestAnimationFrame(animateScroll);
} else {
    cb && cb();
}
};

    window.requestAnimationFrame(animateScroll);
};


    Util.moveFocus = function (element) {
    if( !element ) element = document.getElementsByTagName("body")[0];
    element.focus();
    if (document.activeElement !== element) {
    element.setAttribute('tabindex','-1');
    element.focus();
}
};


    Util.getIndexInArray = function(array, el) {
    return Array.prototype.indexOf.call(array, el);
};

    Util.cssSupports = function(property, value) {
    if('CSS' in window) {
    return CSS.supports(property, value);
} else {
    var jsProperty = property.replace(/-([a-z])/g, function (g) { return g[1].toUpperCase();});
    return jsProperty in document.body.style;
}
};

    if (!Element.prototype.matches) {
    Element.prototype.matches = Element.prototype.msMatchesSelector || Element.prototype.webkitMatchesSelector;
}

    if (!Element.prototype.closest) {
    Element.prototype.closest = function(s) {
        var el = this;
        if (!document.documentElement.contains(el)) return null;
        do {
            if (el.matches(s)) return el;
            el = el.parentElement || el.parentNode;
        } while (el !== null && el.nodeType === 1);
        return null;
    };
}

    if ( typeof window.CustomEvent !== "function" ) {

    function CustomEvent ( event, params ) {
        params = params || { bubbles: false, cancelable: false, detail: undefined };
        var evt = document.createEvent( 'CustomEvent' );
        evt.initCustomEvent( event, params.bubbles, params.cancelable, params.detail );
        return evt;
    }

    CustomEvent.prototype = window.Event.prototype;

    window.CustomEvent = CustomEvent;
}

    Math.easeInOutQuad = function (t, b, c, d) {
    t /= d/2;
    if (t < 1) return c/2*t*t + b;
    t--;
    return -c/2 * (t*(t-2) - 1) + b;
};

    (function() {
    var HorizontalTimeline = function(element) {
    this.element = element;
    this.datesContainer = this.element.getElementsByClassName('h--timeline-dates')[0];
    this.line = this.datesContainer.getElementsByClassName('h--timeline-line')[0];
    this.fillingLine = this.datesContainer.getElementsByClassName('h--timeline-filling-line')[0]
    this.date = this.line.getElementsByClassName('h--timeline-date');
    this.selectedDate = this.line.getElementsByClassName('h--timeline-date--selected')[0];
    this.dateValues = parseDate(this);
    this.minLapse = calcMinLapse(this);
    this.navigation = this.element.getElementsByClassName('h--timeline-navigation');
    this.contentWrapper = this.element.getElementsByClassName('h--timeline-events')[0];
    this.content = this.contentWrapper.getElementsByClassName('h--timeline-event');

    this.eventsMinDistance = 180;
    this.eventsMaxDistance = 160;
    this.translate = 0;
    this.lineLength = 0;

    this.oldDateIndex = Util.getIndexInArray(this.date, this.selectedDate);
    this.newDateIndex = this.oldDateIndex;

    this.isAnimating = false;

    initTimeline(this);
    initEvents(this);
};

    function initTimeline(timeline) {
    var left = 0;
    for (var i = 0; i < timeline.dateValues.length; i++) {
    var j = (i == 0) ? 0 : i - 1;
    var distance = daydiff(timeline.dateValues[j], timeline.dateValues[i]),
    distanceNorm = (Math.round(distance/timeline.minLapse) + 2)*timeline.eventsMinDistance,
    containerWidth = timeline.datesContainer.offsetWidth,
    distanceCorrecture = 0;

    if(distanceNorm < timeline.eventsMinDistance) {
    distanceNorm = timeline.eventsMaxDistance;
} else if(distanceNorm > timeline.eventsMaxDistance) {
    distanceNorm = timeline.eventsMinDistance;
}
    left = left + distanceNorm;
    timeline.date[i].setAttribute('style', 'left:' + left+'px');
}

    timeline.line.style.width = (left + timeline.eventsMinDistance)+distanceCorrecture+'px';
    timeline.lineLength = left + timeline.eventsMinDistance+distanceCorrecture;

    if(containerWidth > timeline.lineLength) {
    timeline.line.style.width = (left + timeline.eventsMinDistance)+distanceCorrecture+'px';
    timeline.lineLength = timeline.lineLength + distanceCorrecture;
}

    Util.addClass(timeline.element, 'h--timeline--loaded');
    selectNewDate(timeline, timeline.selectedDate);
    resetTimelinePosition(timeline, 'next');
};

        function initEvents(timeline) {
            var self = timeline;

            deaktivateNavigationButtons(self);

            self.navigation[0].addEventListener('click', function(event){
                event.preventDefault();
                if (!self.isAnimating) {
                    self.isAnimating = true;
                    keyNavigateTimeline(self, 'prev');
                    deaktivateNavigationButtons(self);
                }
            });

            self.navigation[1].addEventListener('click', function(event){
                event.preventDefault();
                if (!self.isAnimating) {
                    self.isAnimating = true;
                    keyNavigateTimeline(self, 'next');
                    deaktivateNavigationButtons(self);
                }
            });

            var prevBtn = document.getElementById('prevtBtn');
            var nextBtn = document.getElementById('nextBtn');

            if (prevBtn) {
                prevBtn.addEventListener('click', function () {
                    if (!self.isAnimating && self.newDateIndex > 0) {
                        self.isAnimating = true;
                        keyNavigateTimeline(self, 'prev');
                        deaktivateNavigationButtons(self);
                    }
                });
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', function () {
                    if (!self.isAnimating && self.newDateIndex < self.date.length - 1) {
                        self.isAnimating = true;
                        keyNavigateTimeline(self, 'next');
                        deaktivateNavigationButtons(self);
                    }
                });
            }

            new SwipeContent(self.datesContainer);
            self.datesContainer.addEventListener('swipeLeft', function(event){
                if (self.newDateIndex < self.date.length - 1) {
                    translateTimeline(self, 'next');
                }
            });

            self.datesContainer.addEventListener('swipeRight', function(event){
                if (self.newDateIndex > 0) {
                    translateTimeline(self, 'prev');
                }
            });

            for (var i = 0; i < self.date.length; i++) {
                (function(i){
                    self.date[i].addEventListener('click', function(event){
                        selectNewDate(self, event.target);
                    });
                })(i);
            }

            for (var i = 0; i < self.content.length; i++) {
                (function(i){
                    self.content[i].addEventListener('animationend', function(event){
                        if (i == self.newDateIndex && self.newDateIndex != self.oldDateIndex) {
                            resetAnimation(self);
                            self.isAnimating = false;
                        }
                    });
                })(i);
            }
        }

    function updateFilling(timeline) {
    var dateStyle = window.getComputedStyle(timeline.selectedDate, null),
    left = dateStyle.getPropertyValue("left"),
    width = dateStyle.getPropertyValue("width");

    left = Number(left.replace('px', '')) + Number(width.replace('px', ''))/2;
    timeline.fillingLine.style.transform = 'scaleX('+(left/timeline.lineLength)+')';
};

    function translateTimeline(timeline, direction) {
    var containerWidth = timeline.datesContainer.offsetWidth;
    if(direction) {
    timeline.translate = (direction == 'next') ? timeline.translate - containerWidth + timeline.eventsMinDistance : timeline.translate + containerWidth - timeline.eventsMinDistance;
}
    if( 0 - timeline.translate > timeline.lineLength - containerWidth ) timeline.translate = containerWidth - timeline.lineLength;
    if( timeline.translate > 0 ) timeline.translate = 0;

    timeline.line.style.transform = 'translateX('+timeline.translate+'px)';
};

    function deaktivateNavigationButtons(timeline) {
    var containerWidth = timeline.datesContainer.offsetWidth;
    if(containerWidth >= timeline.lineLength) {
    Util.addClass(timeline.navigation[0], 'h--timeline-navigation--inactive');
    Util.addClass(timeline.navigation[1], 'h--timeline-navigation--inactive');
}
};

        function selectNewDate(timeline, target) {
            timeline.newDateIndex = Util.getIndexInArray(timeline.date, target);
            timeline.oldDateIndex = Util.getIndexInArray(timeline.date, timeline.selectedDate);

            Util.removeClass(timeline.selectedDate, 'h--timeline-date--selected');
            Util.addClass(timeline.date[timeline.newDateIndex], 'h--timeline-date--selected');
            timeline.selectedDate = timeline.date[timeline.newDateIndex];

            updateOlderEvents(timeline);
            updateVisibleContent(timeline);
            updateFilling(timeline);

            if (timeline.newDateIndex === 0) {
                Util.addClass(timeline.navigation[0], 'h--timeline-navigation--inactive');
            } else {
                Util.removeClass(timeline.navigation[0], 'h--timeline-navigation--inactive');
            }

            if (timeline.newDateIndex === timeline.date.length - 1) {
                Util.addClass(timeline.navigation[1], 'h--timeline-navigation--inactive');
            } else {
                Util.removeClass(timeline.navigation[1], 'h--timeline-navigation--inactive');
            }

            var prevBtn = document.getElementById('prevtBtn');
            var nextBtn = document.getElementById('nextBtn');

            if (prevBtn) {
                if (timeline.newDateIndex === 0) {
                    console.log('asd')
                    Util.addClass(prevBtn, 'disabled');
                } else {
                    console.log('123')
                    Util.removeClass(prevBtn, 'disabled');
                }
            }

            if (nextBtn) {
                if (timeline.newDateIndex === timeline.date.length - 1) {
                    Util.addClass(nextBtn, 'disabled');
                } else {
                    Util.removeClass(nextBtn, 'disabled');
                }
            }
        }

    function updateOlderEvents(timeline) {
    for(var i = 0; i < timeline.date.length; i++) {
    (i < timeline.newDateIndex) ? Util.addClass(timeline.date[i], 'h--timeline-date--older-event') : Util.removeClass(timeline.date[i], 'h--timeline-date--older-event');
}
};

    function updateVisibleContent(timeline) {
    if (timeline.newDateIndex > timeline.oldDateIndex) {
    var classEntering = 'h--timeline-event--selected h--timeline-event--enter-right',
    classLeaving = 'h--timeline-event--leave-left';
} else if(timeline.newDateIndex < timeline.oldDateIndex) {
    var classEntering = 'h--timeline-event--selected h--timeline-event--enter-left',
    classLeaving = 'h--timeline-event--leave-right';
} else {
    var classEntering = 'h--timeline-event--selected',
    classLeaving = '';
}

    Util.addClass(timeline.content[timeline.newDateIndex], classEntering);
    if (timeline.newDateIndex != timeline.oldDateIndex) {
    Util.removeClass(timeline.content[timeline.oldDateIndex], 'h--timeline-event--selected');
    Util.addClass(timeline.content[timeline.oldDateIndex], classLeaving);
}
};

    function resetAnimation(timeline) {
    Util.removeClass(timeline.content[timeline.newDateIndex], 'h--timeline-event--enter-right h--timeline-event--enter-left');
    Util.removeClass(timeline.content[timeline.oldDateIndex], 'h--timeline-event--leave-right h--timeline-event--leave-left');
};

    function keyNavigateTimeline(timeline, direction) {
    var newIndex = (direction == 'next') ? timeline.newDateIndex + 1 : timeline.newDateIndex - 1;
    if(newIndex < 0 || newIndex >= timeline.date.length) return;
    selectNewDate(timeline, timeline.date[newIndex]);
    resetTimelinePosition(timeline, direction);
};

    function resetTimelinePosition(timeline, direction) {
    var eventStyle = window.getComputedStyle(timeline.selectedDate, null),
    eventLeft = Number(eventStyle.getPropertyValue('left').replace('px', '')),
    timelineWidth = timeline.datesContainer.offsetWidth;

    var threshold = 200;

    if ((direction == 'next' && eventLeft >= timelineWidth - timeline.translate - threshold) || (direction == 'prev' && eventLeft <= - timeline.translate + threshold)) {
    timeline.translate = timelineWidth/2 - eventLeft;
    translateTimeline(timeline, false);
}
};

    function parseDate(timeline) {
    var dateArrays = [];
    for(var i = 0; i < timeline.date.length; i++) {
    var singleDate = timeline.date[i].getAttribute('data-date'),
    dateComp = singleDate.split('T');

    if( dateComp.length > 1 ) {
    var dayComp = dateComp[0].split('/'),
    timeComp = dateComp[1].split(':');
} else if( dateComp[0].indexOf(':') >=0 ) {
    var dayComp = ["2000", "0", "0"],
    timeComp = dateComp[0].split(':');
} else {
    var dayComp = dateComp[0].split('/'),
    timeComp = ["0", "0"];
}
    var	newDate = new Date(dayComp[2], dayComp[1]-1, dayComp[0], timeComp[0], timeComp[1]);
    dateArrays.push(newDate);
}
    return dateArrays;
};

    function calcMinLapse(timeline) {
    var dateDistances = [];
    for(var i = 1; i < timeline.dateValues.length; i++) {
    var distance = daydiff(timeline.dateValues[i-1], timeline.dateValues[i]);
    if(distance > 0) dateDistances.push(distance);
}

    return (dateDistances.length > 0 ) ? Math.min.apply(null, dateDistances) : 86400000;
};

    function daydiff(first, second) {
    return Math.round((second-first));
};

    window.HorizontalTimeline = HorizontalTimeline;

    var horizontalTimeline = document.getElementsByClassName('js-h--timeline'),
    horizontalTimelineTimelineArray = [];
    if(horizontalTimeline.length > 0) {
    for(var i = 0; i < horizontalTimeline.length; i++) {
    horizontalTimelineTimelineArray.push(new HorizontalTimeline(horizontalTimeline[i]));
}
    document.addEventListener('keydown', function(event){
    if( (event.keyCode && event.keyCode == 39) || ( event.key && event.key.toLowerCase() == 'arrowright') ) {
    updateHorizontalTimeline('next');
} else if((event.keyCode && pevent.keyCode == 37) || ( event.key && event.key.toLowerCase() == 'arrowleft')) {
    updateHorizontalTimeline('prev');
}
});
};

    function updateHorizontalTimeline(direction) {
    for(var i = 0; i < horizontalTimelineTimelineArray.length; i++) {
    if(elementInViewport(horizontalTimeline[i])) keyNavigateTimeline(horizontalTimelineTimelineArray[i], direction);
}
};

    function elementInViewport(el) {
    var top = el.offsetTop;
    var left = el.offsetLeft;
    var width = el.offsetWidth;
    var height = el.offsetHeight;

    while(el.offsetParent) {
    el = el.offsetParent;
    top += el.offsetTop;
    left += el.offsetLeft;
}

    return (
    top < (window.pageYOffset + window.innerHeight) &&
    left < (window.pageXOffset + window.innerWidth) &&
    (top + height) > window.pageYOffset &&
    (left + width) > window.pageXOffset
    );
}
        var timeline = horizontalTimelineTimelineArray[0];

        var prevBtn = document.getElementById('prevtBtn');
        var nextBtn = document.getElementById('nextBtn');

        if (!timeline) {
            console.error("Таймлайн не найден");
            return;
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', function (event) {
                event.preventDefault();
                if (!timeline.isAnimating) {
                    timeline.isAnimating = true;
                    keyNavigateTimeline(timeline, 'prev');
                    deaktivateNavigationButtons(timeline);
                }
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function (event) {
                event.preventDefault();
                if (!timeline.isAnimating) {
                    timeline.isAnimating = true;
                    keyNavigateTimeline(timeline, 'next');
                    deaktivateNavigationButtons(timeline);
                }
            });
        }

        function updateButtonState() {
            if (prevBtn) {
                prevBtn.disabled = (timeline.newDateIndex === 0);
            }
            if (nextBtn) {
                nextBtn.disabled = (timeline.newDateIndex === timeline.date.length - 1);
            }
        }

        var originalSelectNewDate = window.selectNewDate;
        window.selectNewDate = function (timeline, target) {
            originalSelectNewDate(timeline, target);
            updateButtonState();
        };

        updateButtonState();}());
