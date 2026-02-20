document.addEventListener('DOMContentLoaded', () => {
    $.js = function (el) {
        return $('[data-js=' + el + ']')
    };

    function carousel() {
        $.js('timeline-carousel').slick({
            infinite: false,
            arrows: true,
            dots: true,
            autoplay: false,
            speed: 1100,
            slidesToShow: 1,
            slidesToScroll: 1,
            draggable: false,
            responsive: [
                {
                    breakpoint: 520,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }]
        });
    }

    jQuery(document).ready(function ($) {
        var timelines = $('.cd-horizontal-timeline'),
            eventsMinDistance = 70;

        (timelines.length > 0) && initTimeline(timelines);

        function initTimeline(timelines) {
            timelines.each(function () {
                var timeline = $(this),
                    timelineComponents = {};
                timelineComponents['timelineWrapper'] = timeline.find('.events-wrapper');
                timelineComponents['eventsWrapper'] = timelineComponents['timelineWrapper'].children('.events');
                timelineComponents['fillingLine'] = timelineComponents['eventsWrapper'].children('.filling-line');
                timelineComponents['timelineEvents'] = timelineComponents['eventsWrapper'].find('a');
                timelineComponents['timelineDates'] = parseDate(timelineComponents['timelineEvents']);
                timelineComponents['eventsMinLapse'] = minLapse(timelineComponents['timelineDates']);
                timelineComponents['timelineNavigation'] = timeline.find('.cd-timeline-navigation');

                setDatePosition(timelineComponents, eventsMinDistance);
                var timelineTotWidth = setTimelineWidth(timelineComponents, eventsMinDistance);
                timeline.addClass('loaded');

                timelineComponents['timelineNavigation'].on('click', '.next', function (event) {
                    event.preventDefault();
                    updateSlide(timelineComponents, timelineTotWidth, 'next');
                });
                timelineComponents['timelineNavigation'].on('click', '.prev', function (event) {
                    event.preventDefault();
                    updateSlide(timelineComponents, timelineTotWidth, 'prev');
                });
                timelineComponents['eventsWrapper'].on('click', 'a', function (event) {
                    event.preventDefault();
                    timelineComponents['timelineEvents'].removeClass('selected');
                    $(this).addClass('selected');
                    updateOlderEvents($(this));
                    updateFilling($(this), timelineComponents['fillingLine'], timelineTotWidth);
                });
                $(document).keyup(function (event) {
                    if (event.which == '37' && elementInViewport(timeline.get(0))) {
                        showNewContent(timelineComponents, timelineTotWidth, 'prev');
                    } else if (event.which == '39' && elementInViewport(timeline.get(0))) {
                        showNewContent(timelineComponents, timelineTotWidth, 'next');
                    }
                });
            });
        }

        function updateSlide(timelineComponents, timelineTotWidth, string) {
            var translateValue = getTranslateValue(timelineComponents['eventsWrapper']),
                wrapperWidth = Number(timelineComponents['timelineWrapper'].css('width').replace('px', ''));
            (string == 'next')
                ? translateTimeline(timelineComponents, translateValue - wrapperWidth + eventsMinDistance, wrapperWidth - timelineTotWidth)
                : translateTimeline(timelineComponents, translateValue + wrapperWidth - eventsMinDistance);
        }

        function updateTimelinePosition(string, event, timelineComponents, timelineTotWidth) {
            var eventStyle = window.getComputedStyle(event.get(0), null),
                eventLeft = Number(eventStyle.getPropertyValue("left").replace('px', '')),
                timelineWidth = Number(timelineComponents['timelineWrapper'].css('width').replace('px', '')),
                timelineTotWidth = Number(timelineComponents['eventsWrapper'].css('width').replace('px', ''));
            var timelineTranslate = getTranslateValue(timelineComponents['eventsWrapper']);

            if ((string == 'next' && eventLeft > timelineWidth - timelineTranslate) || (string == 'prev' && eventLeft < -timelineTranslate)) {
                translateTimeline(timelineComponents, -eventLeft + timelineWidth / 2, timelineWidth - timelineTotWidth);
            }
        }

        function translateTimeline(timelineComponents, value, totWidth) {
            var eventsWrapper = timelineComponents['eventsWrapper'].get(0);
            value = (value > 0) ? 0 : value; //only negative translate value
            value = (!(typeof totWidth === 'undefined') && value < totWidth) ? totWidth : value;
            setTransformValue(eventsWrapper, 'translateX', value + 'px');
            (value == 0) ? timelineComponents['timelineNavigation'].find('.prev').addClass('inactive') : timelineComponents['timelineNavigation'].find('.prev').removeClass('inactive');
            (value == totWidth) ? timelineComponents['timelineNavigation'].find('.next').addClass('inactive') : timelineComponents['timelineNavigation'].find('.next').removeClass('inactive');
        }

        function updateFilling(selectedEvent, filling, totWidth) {
            //change .filling-line length according to the selected event
            var eventStyle = window.getComputedStyle(selectedEvent.get(0), null),
                eventLeft = eventStyle.getPropertyValue("left"),
                eventWidth = eventStyle.getPropertyValue("width");
            eventLeft = Number(eventLeft.replace('px', '')) + Number(eventWidth.replace('px', '')) / 2;
            var scaleValue = eventLeft / totWidth;
            setTransformValue(filling.get(0), 'scaleX', scaleValue);
        }

        function setDatePosition(timelineComponents, min) {
            for (let i = 0; i < timelineComponents['timelineDates'].length; i++) {
                var distance = daydiff(timelineComponents['timelineDates'][0], timelineComponents['timelineDates'][i]),
                    distanceNorm = Math.round(distance / timelineComponents['eventsMinLapse']) + 2;
                timelineComponents['timelineEvents'].eq(i).css('left', distanceNorm * min + 'px');
            }
        }

        function setTimelineWidth(timelineComponents, width) {
            var timeSpan = daydiff(timelineComponents['timelineDates'][0], timelineComponents['timelineDates'][timelineComponents['timelineDates'].length - 1]),
                timeSpanNorm = timeSpan / timelineComponents['eventsMinLapse'],
                timeSpanNorm = Math.round(timeSpanNorm) + 4,
                totalWidth = timeSpanNorm * width;
            timelineComponents['eventsWrapper'].css('width', totalWidth + 'px');
            updateFilling(timelineComponents['timelineEvents'].eq(0), timelineComponents['fillingLine'], totalWidth);

            return totalWidth;
        }

        function updateOlderEvents(event) {
            event.parent('li').prevAll('li').children('a').addClass('older-event').end().end().nextAll('li').children('a').removeClass('older-event');
        }

        function getTranslateValue(timeline) {
            var timelineStyle = window.getComputedStyle(timeline.get(0), null),
                timelineTranslate = timelineStyle.getPropertyValue("-webkit-transform") ||
                    timelineStyle.getPropertyValue("-moz-transform") ||
                    timelineStyle.getPropertyValue("-ms-transform") ||
                    timelineStyle.getPropertyValue("-o-transform") ||
                    timelineStyle.getPropertyValue("transform");
            if (timelineTranslate.indexOf('(') >= 0) {
                var timelineTranslate = timelineTranslate.split('(')[1];
                timelineTranslate = timelineTranslate.split(')')[0];
                timelineTranslate = timelineTranslate.split(',');
                var translateValue = timelineTranslate[4];
            } else {
                var translateValue = 0;
            }

            return Number(translateValue);
        }

        function setTransformValue(element, property, value) {
            element.style["-webkit-transform"] = property + "(" + value + ")";
            element.style["-moz-transform"] = property + "(" + value + ")";
            element.style["-ms-transform"] = property + "(" + value + ")";
            element.style["-o-transform"] = property + "(" + value + ")";
            element.style["transform"] = property + "(" + value + ")";
        }

        function parseDate(events) {
            var dateArrays = [];
            events.each(function () {
                var dateComp = $(this).data('date').split('/'),
                    newDate = new Date(dateComp[2], dateComp[1] - 1, dateComp[0]);
                dateArrays.push(newDate);
            });
            return dateArrays;
        }

        function parseDate2(events) {
            var dateArrays = [];
            events.each(function () {
                var singleDate = $(this),
                    dateComp = singleDate.data('date').split('T');
                if (dateComp.length > 1) {
                    var dayComp = dateComp[0].split('/'),
                        timeComp = dateComp[1].split(':');
                } else if (dateComp[0].indexOf(':') >= 0) {
                    var dayComp = ["2000", "0", "0"],
                        timeComp = dateComp[0].split(':');
                } else {
                    var dayComp = dateComp[0].split('/'),
                        timeComp = ["0", "0"];
                }
                var newDate = new Date(dayComp[2], dayComp[1] - 1, dayComp[0], timeComp[0], timeComp[1]);
                dateArrays.push(newDate);
            });
            return dateArrays;
        }

        function daydiff(first, second) {
            return Math.round((second - first));
        }

        function minLapse(dates) {
            var dateDistances = [];
            for (let i = 1; i < dates.length; i++) {
                var distance = daydiff(dates[i - 1], dates[i]);
                dateDistances.push(distance);
            }
            return Math.min.apply(null, dateDistances);
        }

        function elementInViewport(el) {
            var top = el.offsetTop;
            var left = el.offsetLeft;
            var width = el.offsetWidth;
            var height = el.offsetHeight;

            while (el.offsetParent) {
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

        function checkMQ() {
            return window.getComputedStyle(document.querySelector('.cd-horizontal-timeline'), '::before').getPropertyValue('content').replace(/'/g, "").replace(/"/g, "");
        }

        let $timeLinePoints = $('.timelinePoints li a');
        let $dotsLi = $('.slick-dots li');

        $timeLinePoints.on('click', function (event) {
            event.preventDefault();

            let index = $timeLinePoints.index(this);

            if ($dotsLi.length > index) {
                $($dotsLi[index]).click();
            } else {
                console.error("err");
            }
        });

        let $navTimelinePrev = $('.nav-btn-timeline li a.prev');
        let $navTimelineNext = $('.nav-btn-timeline li a.next');

        let $slickPrev = $('.slick-prev');
        let $slickNext = $('.slick-next');
        $navTimelinePrev.on('click', function (e) {
            $slickPrev.click();
        });
        $navTimelineNext.on('click', function (e) {
            $slickNext.click();
        });

    });
    carousel();

})
