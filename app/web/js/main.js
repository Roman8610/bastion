"use strict";(self.webpackChunkbastionpk=self.webpackChunkbastionpk||[]).push([[522],{275:(t,n,e)=>{var r=e(306),i=e(764),o=e(711),a=e.n(o);function l(t,n){var e="undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"];if(!e){if(Array.isArray(t)||(e=function(t,n){if(!t)return;if("string"==typeof t)return u(t,n);var e=Object.prototype.toString.call(t).slice(8,-1);"Object"===e&&t.constructor&&(e=t.constructor.name);if("Map"===e||"Set"===e)return Array.from(t);if("Arguments"===e||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(e))return u(t,n)}(t))||n&&t&&"number"==typeof t.length){e&&(t=e);var r=0,i=function(){};return{s:i,n:function(){return r>=t.length?{done:!0}:{done:!1,value:t[r++]}},e:function(t){throw t},f:i}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var o,a=!0,l=!1;return{s:function(){e=e.call(t)},n:function(){var t=e.next();return a=t.done,t},e:function(t){l=!0,o=t},f:function(){try{a||null==e.return||e.return()}finally{if(l)throw o}}}}function u(t,n){(null==n||n>t.length)&&(n=t.length);for(var e=0,r=new Array(n);e<n;e++)r[e]=t[e];return r}const s={isOpen:!1,list:[],defaultModalConfig:{active:!1,data:{}},selectors:{modal:"[data-modal]"},init:function(){var t=this;this.collectModals().forEach((function(n){t.list.push(Object.assign({id:n.dataset.modal},t.defaultModalConfig))}))},collectModals:function(){return document.querySelectorAll(this.selectors.modal)},find:function(t){return this.list.find((function(n){return n.id===t}))},open:function(t){this.find(t).active=!0,this.isOpen=!0},close:function(t){this.find(t).active=!1,this.isOpen=!1,this.flushData(t)},toggle:function(t){this.find(t).active?(this.close(t),this.isOpen=!0):(this.open(t),this.isOpen=!1,this.flushData(t))},closeAll:function(){var t,n=l(this.list);try{for(n.s();!(t=n.n()).done;){var e=t.value;e.active=!1,e.data={}}}catch(t){n.e(t)}finally{n.f()}this.isOpen=!1},flushData:function(t){this.find(t).data={}}};function c(t){return c="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},c(t)}function f(t,n,e){return(n=function(t){var n=function(t,n){if("object"!==c(t)||null===t)return t;var e=t[Symbol.toPrimitive];if(void 0!==e){var r=e.call(t,n||"default");if("object"!==c(r))return r;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===n?String:Number)(t)}(t,"string");return"symbol"===c(n)?n:String(n)}(n))in t?Object.defineProperty(t,n,{value:e,enumerable:!0,configurable:!0,writable:!0}):t[n]=e,t}e.g.Alpine=r.Z,e(213),r.Z.plugin(i.Z),r.Z.store("modals",s),r.Z.data("modalTrigger",(function(t){return{modalId:t||"callback",trigger:f({},"@click.prevent",(function(n){var e=n.target.dataset.info;e&&(r.Z.store("modals").find(t).data=JSON.parse(e)),r.Z.store("modals").open(t)}))}})),a().init(),r.Z.store("headerFixed",{scrolled:!1,init:function(){var t=this;window.addEventListener("scroll",(function(){t.scrolled=window.outerWidth>=768&&window.scrollY>=document.querySelector("#header").offsetHeight}))}}),r.Z.start()},39:()=>{}},t=>{var n=n=>t(t.s=n);t.O(0,[72,898],(()=>(n(275),n(39))));t.O()}]);


document.addEventListener("DOMContentLoaded", () => {
  const appHeight = () => {
    const header = document.querySelector('.header');
    const doc = document.documentElement;
  
    doc.style.setProperty('--app-height', `${window.innerHeight}px`);
  }
  
  appHeight();
  window.addEventListener('resize', appHeight);
});

document.querySelectorAll('.ahover').forEach(anchor => {
  if (anchor) {
    anchor.addEventListener('click', function (e) {

      e.preventDefault();

      let targetId = this.getAttribute('href').substring(1);
      let targetElement = document.getElementById(targetId);
      if (document.getElementById(targetId)) {
        targetElement.scrollIntoView({
          behavior: 'smooth',
          block: 'end',
        });


        targetElement.scroll(
          {
            top: 500
          }
        );

      }

    });
  }
});


document.addEventListener("DOMContentLoaded",(function(){const e=document.getElementById("back_to_top");window.addEventListener("scroll",(function(){window.pageYOffset>300?e.style.display="block":e.style.display="none"})),e.addEventListener("click",(function(e){e.preventDefault(),window.scrollTo({top:0,behavior:"smooth"})}))}));
let localStorage=window.localStorage||{};if(!localStorage.getItem("cookieConsent")){const e=document.getElementById("cookie_accept"),o=document.getElementById("cookie_notification");e.addEventListener("click",(()=>{o.style.display="none",localStorage.setItem("cookieConsent","1")})),o.style.display="block"};

/*! Lazy Load 2.0.0-rc.2 - MIT license - Copyright 2007-2019 Mika Tuupola */
!function(t,e){"object"==typeof exports?module.exports=e(t):"function"==typeof define&&define.amd?define([],e):t.LazyLoad=e(t)}("undefined"!=typeof global?global:this.window||this.global,function(t){"use strict";function e(t,e){this.settings=s(r,e||{}),this.images=t||document.querySelectorAll(this.settings.selector),this.observer=null,this.init()}"function"==typeof define&&define.amd&&(t=window);const r={src:"data-src",srcset:"data-srcset",selector:".lazyload",root:null,rootMargin:"0px",threshold:0},s=function(){let t={},e=!1,r=0,o=arguments.length;"[object Boolean]"===Object.prototype.toString.call(arguments[0])&&(e=arguments[0],r++);for(;r<o;r++)!function(r){for(let o in r)Object.prototype.hasOwnProperty.call(r,o)&&(e&&"[object Object]"===Object.prototype.toString.call(r[o])?t[o]=s(!0,t[o],r[o]):t[o]=r[o])}(arguments[r]);return t};if(e.prototype={init:function(){if(!t.IntersectionObserver)return void this.loadImages();let e=this,r={root:this.settings.root,rootMargin:this.settings.rootMargin,threshold:[this.settings.threshold]};this.observer=new IntersectionObserver(function(t){Array.prototype.forEach.call(t,function(t){if(t.isIntersecting){e.observer.unobserve(t.target);let r=t.target.getAttribute(e.settings.src),s=t.target.getAttribute(e.settings.srcset);"img"===t.target.tagName.toLowerCase()?(r&&(t.target.src=r),s&&(t.target.srcset=s)):t.target.style.backgroundImage="url("+r+")"}})},r),Array.prototype.forEach.call(this.images,function(t){e.observer.observe(t)})},loadAndDestroy:function(){this.settings&&(this.loadImages(),this.destroy())},loadImages:function(){if(!this.settings)return;let t=this;Array.prototype.forEach.call(this.images,function(e){let r=e.getAttribute(t.settings.src),s=e.getAttribute(t.settings.srcset);"img"===e.tagName.toLowerCase()?(r&&(e.src=r),s&&(e.srcset=s)):e.style.backgroundImage="url('"+r+"')"})},destroy:function(){this.settings&&(this.observer.disconnect(),this.settings=null)}},t.lazyload=function(t,r){return new e(t,r)},t.jQuery){const r=t.jQuery;r.fn.lazyload=function(t){return t=t||{},t.attribute=t.attribute||"data-src",new e(r.makeArray(this),t),this}}return e});

lazyload();