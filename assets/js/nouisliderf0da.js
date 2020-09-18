!function(t){"function"==typeof define&&define.amd?define([],t):"object"==typeof exports?module.exports=t():window.noUiSlider=t()}(function(){"use strict";var t="14.0.2";function e(t){t.parentElement.removeChild(t)}function r(t){return null!=t}function n(t){t.preventDefault()}function i(t){return"number"==typeof t&&!isNaN(t)&&isFinite(t)}function o(t,e,r){r>0&&(u(t,e),setTimeout(function(){c(t,e)},r))}function a(t){return Math.max(Math.min(t,100),0)}function s(t){return Array.isArray(t)?t:[t]}function l(t){var e=(t=String(t)).split(".");return e.length>1?e[1].length:0}function u(t,e){t.classList?t.classList.add(e):t.className+=" "+e}function c(t,e){t.classList?t.classList.remove(e):t.className=t.className.replace(new RegExp("(^|\\b)"+e.split(" ").join("|")+"(\\b|$)","gi")," ")}function p(t){var e=void 0!==window.pageXOffset,r="CSS1Compat"===(t.compatMode||"");return{x:e?window.pageXOffset:r?t.documentElement.scrollLeft:t.body.scrollLeft,y:e?window.pageYOffset:r?t.documentElement.scrollTop:t.body.scrollTop}}function f(t,e){return 100/(e-t)}function d(t,e){return 100*e/(t[1]-t[0])}function h(t,e){for(var r=1;t>=e[r];)r+=1;return r}function m(t,e,r){if(r>=t.slice(-1)[0])return 100;var n=h(r,t),i=t[n-1],o=t[n],a=e[n-1],s=e[n];return a+function(t,e){return d(t,t[0]<0?e+Math.abs(t[0]):e-t[0])}([i,o],r)/f(a,s)}function g(t,e,r,n){if(100===n)return n;var i=h(n,t),o=t[i-1],a=t[i];return r?n-o>(a-o)/2?a:o:e[i-1]?t[i-1]+function(t,e){return Math.round(t/e)*e}(n-t[i-1],e[i-1]):n}function v(e,r,n){var o;if("number"==typeof r&&(r=[r]),!Array.isArray(r))throw new Error("noUiSlider ("+t+"): 'range' contains invalid value.");if(!i(o="min"===e?0:"max"===e?100:parseFloat(e))||!i(r[0]))throw new Error("noUiSlider ("+t+"): 'range' value isn't numeric.");n.xPct.push(o),n.xVal.push(r[0]),o?n.xSteps.push(!isNaN(r[1])&&r[1]):isNaN(r[1])||(n.xSteps[0]=r[1]),n.xHighestCompleteStep.push(0)}function b(t,e,r){if(e)if(r.xVal[t]!==r.xVal[t+1]){r.xSteps[t]=d([r.xVal[t],r.xVal[t+1]],e)/f(r.xPct[t],r.xPct[t+1]);var n=(r.xVal[t+1]-r.xVal[t])/r.xNumSteps[t],i=Math.ceil(Number(n.toFixed(3))-1),o=r.xVal[t]+r.xNumSteps[t]*i;r.xHighestCompleteStep[t]=o}else r.xSteps[t]=r.xHighestCompleteStep[t]=r.xVal[t]}function S(t,e,r){var n;this.xPct=[],this.xVal=[],this.xSteps=[r||!1],this.xNumSteps=[!1],this.xHighestCompleteStep=[],this.snap=e;var i=[];for(n in t)t.hasOwnProperty(n)&&i.push([t[n],n]);for(i.length&&"object"==typeof i[0][0]?i.sort(function(t,e){return t[0][0]-e[0][0]}):i.sort(function(t,e){return t[0]-e[0]}),n=0;n<i.length;n++)v(i[n][1],i[n][0],this);for(this.xNumSteps=this.xSteps.slice(0),n=0;n<this.xNumSteps.length;n++)b(n,this.xNumSteps[n],this)}S.prototype.getMargin=function(e){var r=this.xNumSteps[0];if(r&&e/r%1!=0)throw new Error("noUiSlider ("+t+"): 'limit', 'margin' and 'padding' must be divisible by step.");return 2===this.xPct.length&&d(this.xVal,e)},S.prototype.toStepping=function(t){return t=m(this.xVal,this.xPct,t)},S.prototype.fromStepping=function(t){return function(t,e,r){if(r>=100)return t.slice(-1)[0];var n=h(r,e),i=t[n-1],o=t[n],a=e[n-1];return function(t,e){return e*(t[1]-t[0])/100+t[0]}([i,o],(r-a)*f(a,e[n]))}(this.xVal,this.xPct,t)},S.prototype.getStep=function(t){return t=g(this.xPct,this.xSteps,this.snap,t)},S.prototype.getDefaultStep=function(t,e,r){var n=h(t,this.xPct);return(100===t||e&&t===this.xPct[n-1])&&(n=Math.max(n-1,1)),(this.xVal[n]-this.xVal[n-1])/r},S.prototype.getNearbySteps=function(t){var e=h(t,this.xPct);return{stepBefore:{startValue:this.xVal[e-2],step:this.xNumSteps[e-2],highestStep:this.xHighestCompleteStep[e-2]},thisStep:{startValue:this.xVal[e-1],step:this.xNumSteps[e-1],highestStep:this.xHighestCompleteStep[e-1]},stepAfter:{startValue:this.xVal[e],step:this.xNumSteps[e],highestStep:this.xHighestCompleteStep[e]}}},S.prototype.countStepDecimals=function(){var t=this.xNumSteps.map(l);return Math.max.apply(null,t)},S.prototype.convert=function(t){return this.getStep(this.toStepping(t))};var x={to:function(t){return void 0!==t&&t.toFixed(2)},from:Number};function w(e){if(function(t){return"object"==typeof t&&"function"==typeof t.to&&"function"==typeof t.from}(e))return!0;throw new Error("noUiSlider ("+t+"): 'format' requires 'to' and 'from' methods.")}function y(e,r){if(!i(r))throw new Error("noUiSlider ("+t+"): 'step' is not numeric.");e.singleStep=r}function E(e,r){if("object"!=typeof r||Array.isArray(r))throw new Error("noUiSlider ("+t+"): 'range' is not an object.");if(void 0===r.min||void 0===r.max)throw new Error("noUiSlider ("+t+"): Missing 'min' or 'max' in 'range'.");if(r.min===r.max)throw new Error("noUiSlider ("+t+"): 'range' 'min' and 'max' cannot be equal.");e.spectrum=new S(r,e.snap,e.singleStep)}function C(e,r){if(r=s(r),!Array.isArray(r)||!r.length)throw new Error("noUiSlider ("+t+"): 'start' option is incorrect.");e.handles=r.length,e.start=r}function N(e,r){if(e.snap=r,"boolean"!=typeof r)throw new Error("noUiSlider ("+t+"): 'snap' option must be a boolean.")}function U(e,r){if(e.animate=r,"boolean"!=typeof r)throw new Error("noUiSlider ("+t+"): 'animate' option must be a boolean.")}function k(e,r){if(e.animationDuration=r,"number"!=typeof r)throw new Error("noUiSlider ("+t+"): 'animationDuration' option must be a number.")}function P(e,r){var n,i=[!1];if("lower"===r?r=[!0,!1]:"upper"===r&&(r=[!1,!0]),!0===r||!1===r){for(n=1;n<e.handles;n++)i.push(r);i.push(!1)}else{if(!Array.isArray(r)||!r.length||r.length!==e.handles+1)throw new Error("noUiSlider ("+t+"): 'connect' option doesn't match handle count.");i=r}e.connect=i}function A(e,r){switch(r){case"horizontal":e.ort=0;break;case"vertical":e.ort=1;break;default:throw new Error("noUiSlider ("+t+"): 'orientation' option is invalid.")}}function V(e,r){if(!i(r))throw new Error("noUiSlider ("+t+"): 'margin' option must be numeric.");if(0!==r&&(e.margin=e.spectrum.getMargin(r),!e.margin))throw new Error("noUiSlider ("+t+"): 'margin' option is only supported on linear sliders.")}function M(e,r){if(!i(r))throw new Error("noUiSlider ("+t+"): 'limit' option must be numeric.");if(e.limit=e.spectrum.getMargin(r),!e.limit||e.handles<2)throw new Error("noUiSlider ("+t+"): 'limit' option is only supported on linear sliders with 2 or more handles.")}function O(e,r){if(!i(r)&&!Array.isArray(r))throw new Error("noUiSlider ("+t+"): 'padding' option must be numeric or array of exactly 2 numbers.");if(Array.isArray(r)&&2!==r.length&&!i(r[0])&&!i(r[1]))throw new Error("noUiSlider ("+t+"): 'padding' option must be numeric or array of exactly 2 numbers.");if(0!==r){if(Array.isArray(r)||(r=[r,r]),e.padding=[e.spectrum.getMargin(r[0]),e.spectrum.getMargin(r[1])],!1===e.padding[0]||!1===e.padding[1])throw new Error("noUiSlider ("+t+"): 'padding' option is only supported on linear sliders.");if(e.padding[0]<0||e.padding[1]<0)throw new Error("noUiSlider ("+t+"): 'padding' option must be a positive number(s).");if(e.padding[0]+e.padding[1]>100)throw new Error("noUiSlider ("+t+"): 'padding' option must not exceed 100% of the range.")}}function L(e,r){switch(r){case"ltr":e.dir=0;break;case"rtl":e.dir=1;break;default:throw new Error("noUiSlider ("+t+"): 'direction' option was not recognized.")}}function z(e,r){if("string"!=typeof r)throw new Error("noUiSlider ("+t+"): 'behaviour' must be a string containing options.");var n=r.indexOf("tap")>=0,i=r.indexOf("drag")>=0,o=r.indexOf("fixed")>=0,a=r.indexOf("snap")>=0,s=r.indexOf("hover")>=0,l=r.indexOf("unconstrained")>=0;if(o){if(2!==e.handles)throw new Error("noUiSlider ("+t+"): 'fixed' behaviour must be used with 2 handles");V(e,e.start[1]-e.start[0])}if(l&&(e.margin||e.limit))throw new Error("noUiSlider ("+t+"): 'unconstrained' behaviour cannot be used with margin or limit");e.events={tap:n||a,drag:i,fixed:o,snap:a,hover:s,unconstrained:l}}function j(e,r){if(!1!==r)if(!0===r){e.tooltips=[];for(var n=0;n<e.handles;n++)e.tooltips.push(!0)}else{if(e.tooltips=s(r),e.tooltips.length!==e.handles)throw new Error("noUiSlider ("+t+"): must pass a formatter for all handles.");e.tooltips.forEach(function(e){if("boolean"!=typeof e&&("object"!=typeof e||"function"!=typeof e.to))throw new Error("noUiSlider ("+t+"): 'tooltips' must be passed a formatter or 'false'.")})}}function H(t,e){t.ariaFormat=e,w(e)}function F(t,e){t.format=e,w(e)}function D(e,r){if(e.keyboardSupport=r,"boolean"!=typeof r)throw new Error("noUiSlider ("+t+"): 'keyboardSupport' option must be a boolean.")}function T(t,e){t.documentElement=e}function R(e,r){if("string"!=typeof r&&!1!==r)throw new Error("noUiSlider ("+t+"): 'cssPrefix' must be a string or `false`.");e.cssPrefix=r}function B(e,r){if("object"!=typeof r)throw new Error("noUiSlider ("+t+"): 'cssClasses' must be an object.");if("string"==typeof e.cssPrefix)for(var n in e.cssClasses={},r)r.hasOwnProperty(n)&&(e.cssClasses[n]=e.cssPrefix+r[n]);else e.cssClasses=r}function q(e){var n={margin:0,limit:0,padding:0,animate:!0,animationDuration:300,ariaFormat:x,format:x},i={step:{r:!1,t:y},start:{r:!0,t:C},connect:{r:!0,t:P},direction:{r:!0,t:L},snap:{r:!1,t:N},animate:{r:!1,t:U},animationDuration:{r:!1,t:k},range:{r:!0,t:E},orientation:{r:!1,t:A},margin:{r:!1,t:V},limit:{r:!1,t:M},padding:{r:!1,t:O},behaviour:{r:!0,t:z},ariaFormat:{r:!1,t:H},format:{r:!1,t:F},tooltips:{r:!1,t:j},keyboardSupport:{r:!0,t:D},documentElement:{r:!1,t:T},cssPrefix:{r:!0,t:R},cssClasses:{r:!0,t:B}},o={connect:!1,direction:"ltr",behaviour:"tap",orientation:"horizontal",keyboardSupport:!0,cssPrefix:"noUi-",cssClasses:{target:"target",base:"base",origin:"origin",handle:"handle",handleLower:"handle-lower",handleUpper:"handle-upper",touchArea:"touch-area",horizontal:"horizontal",vertical:"vertical",background:"background",connect:"connect",connects:"connects",ltr:"ltr",rtl:"rtl",draggable:"draggable",drag:"state-drag",tap:"state-tap",active:"active",tooltip:"tooltip",pips:"pips",pipsHorizontal:"pips-horizontal",pipsVertical:"pips-vertical",marker:"marker",markerHorizontal:"marker-horizontal",markerVertical:"marker-vertical",markerNormal:"marker-normal",markerLarge:"marker-large",markerSub:"marker-sub",value:"value",valueHorizontal:"value-horizontal",valueVertical:"value-vertical",valueNormal:"value-normal",valueLarge:"value-large",valueSub:"value-sub"}};e.format&&!e.ariaFormat&&(e.ariaFormat=e.format),Object.keys(i).forEach(function(a){if(!r(e[a])&&void 0===o[a]){if(i[a].r)throw new Error("noUiSlider ("+t+"): '"+a+"' is required.");return!0}i[a].t(n,r(e[a])?e[a]:o[a])}),n.pips=e.pips;var a=document.createElement("div"),s=void 0!==a.style.msTransform,l=void 0!==a.style.transform;n.transformRule=l?"transform":s?"msTransform":"webkitTransform";return n.style=[["left","top"],["right","bottom"]][n.dir][n.ort],n}function X(r,i,l){var f,d,h,m,g,v,b,S,x=window.navigator.pointerEnabled?{start:"pointerdown",move:"pointermove",end:"pointerup"}:window.navigator.msPointerEnabled?{start:"MSPointerDown",move:"MSPointerMove",end:"MSPointerUp"}:{start:"mousedown touchstart",move:"mousemove touchmove",end:"mouseup touchend"},w=window.CSS&&CSS.supports&&CSS.supports("touch-action","none")&&function(){var t=!1;try{var e=Object.defineProperty({},"passive",{get:function(){t=!0}});window.addEventListener("test",null,e)}catch(t){}return t}(),y=r,E=i.spectrum,C=[],N=[],U=[],k=0,P={},A=r.ownerDocument,V=i.documentElement||A.documentElement,M=A.body,O=-1,L=0,z=1,j=2,H="rtl"===A.dir||1===i.ort?0:100;function F(t,e){var r=A.createElement("div");return e&&u(r,e),t.appendChild(r),r}function D(t,e){var r=F(t,i.cssClasses.origin),n=F(r,i.cssClasses.handle);return F(n,i.cssClasses.touchArea),n.setAttribute("data-handle",e),i.keyboardSupport&&(n.setAttribute("tabindex","0"),n.addEventListener("keydown",function(t){return function(t,e){if(B()||X(e))return!1;var r=["Left","Right"],n=["Down","Up"];i.dir&&!i.ort?r.reverse():i.ort&&!i.dir&&n.reverse();var o=t.key.replace("Arrow",""),a=o===n[0]||o===r[0],s=o===n[1]||o===r[1];if(!a&&!s)return!0;t.preventDefault();var l=a?0:1,u=vt(e)[l];if(null===u)return!1;!1===u&&(u=E.getDefaultStep(N[e],a,10));return u=Math.max(u,1e-7),u*=a?-1:1,ft(e,E.toStepping(C[e]+u),!0,!0),at("slide",e),at("update",e),at("change",e),at("set",e),!1}(t,e)})),n.setAttribute("role","slider"),n.setAttribute("aria-orientation",i.ort?"vertical":"horizontal"),0===e?u(n,i.cssClasses.handleLower):e===i.handles-1&&u(n,i.cssClasses.handleUpper),r}function T(t,e){return!!e&&F(t,i.cssClasses.connect)}function R(t,e){return!!i.tooltips[e]&&F(t.firstChild,i.cssClasses.tooltip)}function B(){return y.hasAttribute("disabled")}function X(t){return d[t].hasAttribute("disabled")}function Y(){g&&(ot("update.tooltips"),g.forEach(function(t){t&&e(t)}),g=null)}function _(){Y(),g=d.map(R),it("update.tooltips",function(t,e,r){if(g[e]){var n=t[e];!0!==i.tooltips[e]&&(n=i.tooltips[e].to(r[e])),g[e].innerHTML=n}})}function I(t,e,r){var n=A.createElement("div"),o=[];o[L]=i.cssClasses.valueNormal,o[z]=i.cssClasses.valueLarge,o[j]=i.cssClasses.valueSub;var a=[];a[L]=i.cssClasses.markerNormal,a[z]=i.cssClasses.markerLarge,a[j]=i.cssClasses.markerSub;var s=[i.cssClasses.valueHorizontal,i.cssClasses.valueVertical],l=[i.cssClasses.markerHorizontal,i.cssClasses.markerVertical];function c(t,e){var r=e===i.cssClasses.value,n=r?o:a;return e+" "+(r?s:l)[i.ort]+" "+n[t]}return u(n,i.cssClasses.pips),u(n,0===i.ort?i.cssClasses.pipsHorizontal:i.cssClasses.pipsVertical),Object.keys(t).forEach(function(o){!function(t,o,a){if((a=e?e(o,a):a)!==O){var s=F(n,!1);s.className=c(a,i.cssClasses.marker),s.style[i.style]=t+"%",a>L&&((s=F(n,!1)).className=c(a,i.cssClasses.value),s.setAttribute("data-value",o),s.style[i.style]=t+"%",s.innerHTML=r.to(o))}}(o,t[o][0],t[o][1])}),n}function W(){m&&(e(m),m=null)}function $(e){W();var r=e.mode,n=e.density||1,i=e.filter||!1,o=function(e,r,n){if("range"===e||"steps"===e)return E.xVal;if("count"===e){if(r<2)throw new Error("noUiSlider ("+t+"): 'values' (>= 2) required for mode 'count'.");var i=r-1,o=100/i;for(r=[];i--;)r[i]=i*o;r.push(100),e="positions"}return"positions"===e?r.map(function(t){return E.fromStepping(n?E.getStep(t):t)}):"values"===e?n?r.map(function(t){return E.fromStepping(E.getStep(E.toStepping(t)))}):r:void 0}(r,e.values||!1,e.stepped||!1),a=function(t,e,r){var n,i={},o=E.xVal[0],a=E.xVal[E.xVal.length-1],s=!1,l=!1,u=0;return n=r.slice().sort(function(t,e){return t-e}),(r=n.filter(function(t){return!this[t]&&(this[t]=!0)},{}))[0]!==o&&(r.unshift(o),s=!0),r[r.length-1]!==a&&(r.push(a),l=!0),r.forEach(function(n,o){var a,c,p,f,d,h,m,g,v,b,S=n,x=r[o+1],w="steps"===e;if(w&&(a=E.xNumSteps[o]),a||(a=x-S),!1!==S&&void 0!==x)for(a=Math.max(a,1e-7),c=S;c<=x;c=(c+a).toFixed(7)/1){for(g=(d=(f=E.toStepping(c))-u)/t,b=d/(v=Math.round(g)),p=1;p<=v;p+=1)i[(h=u+p*b).toFixed(5)]=[E.fromStepping(h),0];m=r.indexOf(c)>-1?z:w?j:L,!o&&s&&(m=0),c===x&&l||(i[f.toFixed(5)]=[c,m]),u=f}}),i}(n,r,o),s=e.format||{to:Math.round};return m=y.appendChild(I(a,i,s))}function G(){var t=f.getBoundingClientRect(),e="offset"+["Width","Height"][i.ort];return 0===i.ort?t.width||f[e]:t.height||f[e]}function J(t,e,r,n){var o=function(o){return!!(o=function(t,e,r){var n,i,o=0===t.type.indexOf("touch"),a=0===t.type.indexOf("mouse"),s=0===t.type.indexOf("pointer");0===t.type.indexOf("MSPointer")&&(s=!0);if(o){var l=function(t){return t.target===r||r.contains(t.target)};if("touchstart"===t.type){var u=Array.prototype.filter.call(t.touches,l);if(u.length>1)return!1;n=u[0].pageX,i=u[0].pageY}else{var c=Array.prototype.find.call(t.changedTouches,l);if(!c)return!1;n=c.pageX,i=c.pageY}}e=e||p(A),(a||s)&&(n=t.clientX+e.x,i=t.clientY+e.y);return t.pageOffset=e,t.points=[n,i],t.cursor=a||s,t}(o,n.pageOffset,n.target||e))&&(!(B()&&!n.doNotReject)&&(a=y,s=i.cssClasses.tap,!((a.classList?a.classList.contains(s):new RegExp("\\b"+s+"\\b").test(a.className))&&!n.doNotReject)&&(!(t===x.start&&void 0!==o.buttons&&o.buttons>1)&&((!n.hover||!o.buttons)&&(w||o.preventDefault(),o.calcPoint=o.points[i.ort],void r(o,n))))));var a,s},a=[];return t.split(" ").forEach(function(t){e.addEventListener(t,o,!!w&&{passive:!0}),a.push([t,o])}),a}function K(t){var e,r,n,o,s,l,u=100*(t-(e=f,r=i.ort,n=e.getBoundingClientRect(),o=e.ownerDocument,s=o.documentElement,l=p(o),/webkit.*Chrome.*Mobile/i.test(navigator.userAgent)&&(l.x=0),r?n.top+l.y-s.clientTop:n.left+l.x-s.clientLeft))/G();return u=a(u),i.dir?100-u:u}function Q(t,e){"mouseout"===t.type&&"HTML"===t.target.nodeName&&null===t.relatedTarget&&tt(t,e)}function Z(t,e){if(-1===navigator.appVersion.indexOf("MSIE 9")&&0===t.buttons&&0!==e.buttonsProperty)return tt(t,e);var r=(i.dir?-1:1)*(t.calcPoint-e.startCalcPoint);ut(r>0,100*r/e.baseSize,e.locations,e.handleNumbers)}function tt(t,e){e.handle&&(c(e.handle,i.cssClasses.active),k-=1),e.listeners.forEach(function(t){V.removeEventListener(t[0],t[1])}),0===k&&(c(y,i.cssClasses.drag),pt(),t.cursor&&(M.style.cursor="",M.removeEventListener("selectstart",n))),e.handleNumbers.forEach(function(t){at("change",t),at("set",t),at("end",t)})}function et(t,e){if(e.handleNumbers.some(X))return!1;var r;1===e.handleNumbers.length&&(r=d[e.handleNumbers[0]].children[0],k+=1,u(r,i.cssClasses.active));t.stopPropagation();var o=[],a=J(x.move,V,Z,{target:t.target,handle:r,listeners:o,startCalcPoint:t.calcPoint,baseSize:G(),pageOffset:t.pageOffset,handleNumbers:e.handleNumbers,buttonsProperty:t.buttons,locations:N.slice()}),s=J(x.end,V,tt,{target:t.target,handle:r,listeners:o,doNotReject:!0,handleNumbers:e.handleNumbers}),l=J("mouseout",V,Q,{target:t.target,handle:r,listeners:o,doNotReject:!0,handleNumbers:e.handleNumbers});o.push.apply(o,a.concat(s,l)),t.cursor&&(M.style.cursor=getComputedStyle(t.target).cursor,d.length>1&&u(y,i.cssClasses.drag),M.addEventListener("selectstart",n,!1)),e.handleNumbers.forEach(function(t){at("start",t)})}function rt(t){t.stopPropagation();var e=K(t.calcPoint),r=function(t){var e=100,r=!1;return d.forEach(function(n,i){if(!X(i)){var o=N[i],a=Math.abs(o-t);(a<e||a<=e&&t>o||100===a&&100===e)&&(r=i,e=a)}}),r}(e);if(!1===r)return!1;i.events.snap||o(y,i.cssClasses.tap,i.animationDuration),ft(r,e,!0,!0),pt(),at("slide",r,!0),at("update",r,!0),at("change",r,!0),at("set",r,!0),i.events.snap&&et(t,{handleNumbers:[r]})}function nt(t){var e=K(t.calcPoint),r=E.getStep(e),n=E.fromStepping(r);Object.keys(P).forEach(function(t){"hover"===t.split(".")[0]&&P[t].forEach(function(t){t.call(v,n)})})}function it(t,e){P[t]=P[t]||[],P[t].push(e),"update"===t.split(".")[0]&&d.forEach(function(t,e){at("update",e)})}function ot(t){var e=t&&t.split(".")[0],r=e&&t.substring(e.length);Object.keys(P).forEach(function(t){var n=t.split(".")[0],i=t.substring(n.length);e&&e!==n||r&&r!==i||delete P[t]})}function at(t,e,r){Object.keys(P).forEach(function(n){var o=n.split(".")[0];t===o&&P[n].forEach(function(t){t.call(v,C.map(i.format.to),e,C.slice(),r||!1,N.slice())})})}function st(t,e,r,n,o,s){return d.length>1&&!i.events.unconstrained&&(n&&e>0&&(r=Math.max(r,t[e-1]+i.margin)),o&&e<d.length-1&&(r=Math.min(r,t[e+1]-i.margin))),d.length>1&&i.limit&&(n&&e>0&&(r=Math.min(r,t[e-1]+i.limit)),o&&e<d.length-1&&(r=Math.max(r,t[e+1]-i.limit))),i.padding&&(0===e&&(r=Math.max(r,i.padding[0])),e===d.length-1&&(r=Math.min(r,100-i.padding[1]))),!((r=a(r=E.getStep(r)))===t[e]&&!s)&&r}function lt(t,e){var r=i.ort;return(r?e:t)+", "+(r?t:e)}function ut(t,e,r,n){var i=r.slice(),o=[!t,t],a=[t,!t];n=n.slice(),t&&n.reverse(),n.length>1?n.forEach(function(t,r){var n=st(i,t,i[t]+e,o[r],a[r],!1);!1===n?e=0:(e=n-i[t],i[t]=n)}):o=a=[!0];var s=!1;n.forEach(function(t,n){s=ft(t,r[t]+e,o[n],a[n])||s}),s&&n.forEach(function(t){at("update",t),at("slide",t)})}function ct(t,e){return i.dir?100-t-e:t}function pt(){U.forEach(function(t){var e=N[t]>50?-1:1,r=3+(d.length+e*t);d[t].style.zIndex=r})}function ft(t,e,r,n){return!1!==(e=st(N,t,e,r,n,!1))&&(function(t,e){N[t]=e,C[t]=E.fromStepping(e);var r="translate("+lt(10*(ct(e,0)-H)+"%","0")+")";d[t].style[i.transformRule]=r,dt(t),dt(t+1)}(t,e),!0)}function dt(t){if(h[t]){var e=0,r=100;0!==t&&(e=N[t-1]),t!==h.length-1&&(r=N[t]);var n=r-e,o="translate("+lt(ct(e,n)+"%","0")+")",a="scale("+lt(n/100,"1")+")";h[t].style[i.transformRule]=o+" "+a}}function ht(t,e){return null===t||!1===t||void 0===t?N[e]:("number"==typeof t&&(t=String(t)),t=i.format.from(t),!1===(t=E.toStepping(t))||isNaN(t)?N[e]:t)}function mt(t,e){var r=s(t),n=void 0===N[0];e=void 0===e||!!e,i.animate&&!n&&o(y,i.cssClasses.tap,i.animationDuration),U.forEach(function(t){ft(t,ht(r[t],t),!0,!1)}),U.forEach(function(t){ft(t,N[t],!0,!0)}),pt(),U.forEach(function(t){at("update",t),null!==r[t]&&e&&at("set",t)})}function gt(){var t=C.map(i.format.to);return 1===t.length?t[0]:t}function vt(t){var e=N[t],r=E.getNearbySteps(e),n=C[t],o=r.thisStep.step,a=null;if(i.snap)return[n-r.stepBefore.startValue||null,r.stepAfter.startValue-n||null];!1!==o&&n+o>r.stepAfter.startValue&&(o=r.stepAfter.startValue-n),a=n>r.thisStep.startValue?r.thisStep.step:!1!==r.stepBefore.step&&n-r.stepBefore.highestStep,100===e?o=null:0===e&&(a=null);var s=E.countStepDecimals();return null!==o&&!1!==o&&(o=Number(o.toFixed(s))),null!==a&&!1!==a&&(a=Number(a.toFixed(s))),[a,o]}return u(b=y,i.cssClasses.target),0===i.dir?u(b,i.cssClasses.ltr):u(b,i.cssClasses.rtl),0===i.ort?u(b,i.cssClasses.horizontal):u(b,i.cssClasses.vertical),f=F(b,i.cssClasses.base),function(t,e){var r=F(e,i.cssClasses.connects);d=[],(h=[]).push(T(r,t[0]));for(var n=0;n<i.handles;n++)d.push(D(e,n)),U[n]=n,h.push(T(r,t[n+1]))}(i.connect,f),(S=i.events).fixed||d.forEach(function(t,e){J(x.start,t.children[0],et,{handleNumbers:[e]})}),S.tap&&J(x.start,f,rt,{}),S.hover&&J(x.move,f,nt,{hover:!0}),S.drag&&h.forEach(function(t,e){if(!1!==t&&0!==e&&e!==h.length-1){var r=d[e-1],n=d[e],o=[t];u(t,i.cssClasses.draggable),S.fixed&&(o.push(r.children[0]),o.push(n.children[0])),o.forEach(function(t){J(x.start,t,et,{handles:[r,n],handleNumbers:[e-1,e]})})}}),mt(i.start),i.pips&&$(i.pips),i.tooltips&&_(),it("update",function(t,e,r,n,o){U.forEach(function(t){var e=d[t],n=st(N,t,0,!0,!0,!0),a=st(N,t,100,!0,!0,!0),s=o[t],l=i.ariaFormat.to(r[t]);n=E.fromStepping(n).toFixed(1),a=E.fromStepping(a).toFixed(1),s=E.fromStepping(s).toFixed(1),e.children[0].setAttribute("aria-valuemin",n),e.children[0].setAttribute("aria-valuemax",a),e.children[0].setAttribute("aria-valuenow",s),e.children[0].setAttribute("aria-valuetext",l)})}),v={destroy:function(){for(var t in i.cssClasses)i.cssClasses.hasOwnProperty(t)&&c(y,i.cssClasses[t]);for(;y.firstChild;)y.removeChild(y.firstChild);delete y.noUiSlider},steps:function(){return U.map(vt)},on:it,off:ot,get:gt,set:mt,setHandle:function(e,r,n){if(!((e=Number(e))>=0&&e<U.length))throw new Error("noUiSlider ("+t+"): invalid handle number, got: "+e);ft(e,ht(r,e),!0,!0),at("update",e),n&&at("set",e)},reset:function(t){mt(i.start,t)},__moveHandles:function(t,e,r){ut(t,e,N,r)},options:l,updateOptions:function(t,e){var r=gt(),n=["margin","limit","padding","range","animate","snap","step","format","pips","tooltips"];n.forEach(function(e){void 0!==t[e]&&(l[e]=t[e])});var o=q(l);n.forEach(function(e){void 0!==t[e]&&(i[e]=o[e])}),E=o.spectrum,i.margin=o.margin,i.limit=o.limit,i.padding=o.padding,i.pips?$(i.pips):W(),i.tooltips?_():Y(),N=[],mt(t.start||r,e)},target:y,removePips:W,removeTooltips:Y,pips:$}}return{__spectrum:S,version:t,create:function(e,r){if(!e||!e.nodeName)throw new Error("noUiSlider ("+t+"): create requires a single element, got: "+e);if(e.noUiSlider)throw new Error("noUiSlider ("+t+"): Slider was already initialized.");var n=X(e,q(r),r);return e.noUiSlider=n,n}}});