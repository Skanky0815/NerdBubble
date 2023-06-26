"use strict";(self.webpackChunkdoku=self.webpackChunkdoku||[]).push([[8172],{3905:(e,t,r)=>{r.d(t,{Zo:()=>c,kt:()=>b});var n=r(7294);function i(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}function a(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function s(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?a(Object(r),!0).forEach((function(t){i(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):a(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}function u(e,t){if(null==e)return{};var r,n,i=function(e,t){if(null==e)return{};var r,n,i={},a=Object.keys(e);for(n=0;n<a.length;n++)r=a[n],t.indexOf(r)>=0||(i[r]=e[r]);return i}(e,t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);for(n=0;n<a.length;n++)r=a[n],t.indexOf(r)>=0||Object.prototype.propertyIsEnumerable.call(e,r)&&(i[r]=e[r])}return i}var l=n.createContext({}),o=function(e){var t=n.useContext(l),r=t;return e&&(r="function"==typeof e?e(t):s(s({},t),e)),r},c=function(e){var t=o(e.components);return n.createElement(l.Provider,{value:t},e.children)},p="mdxType",g={inlineCode:"code",wrapper:function(e){var t=e.children;return n.createElement(n.Fragment,{},t)}},d=n.forwardRef((function(e,t){var r=e.components,i=e.mdxType,a=e.originalType,l=e.parentName,c=u(e,["components","mdxType","originalType","parentName"]),p=o(r),d=i,b=p["".concat(l,".").concat(d)]||p[d]||g[d]||a;return r?n.createElement(b,s(s({ref:t},c),{},{components:r})):n.createElement(b,s({ref:t},c))}));function b(e,t){var r=arguments,i=t&&t.mdxType;if("string"==typeof e||i){var a=r.length,s=new Array(a);s[0]=d;var u={};for(var l in t)hasOwnProperty.call(t,l)&&(u[l]=t[l]);u.originalType=e,u[p]="string"==typeof e?e:i,s[1]=u;for(var o=2;o<a;o++)s[o]=r[o];return n.createElement.apply(null,s)}return n.createElement.apply(null,r)}d.displayName="MDXCreateElement"},132:(e,t,r)=>{r.r(t),r.d(t,{assets:()=>l,contentTitle:()=>s,default:()=>g,frontMatter:()=>a,metadata:()=>u,toc:()=>o});var n=r(7462),i=(r(7294),r(3905));const a={},s="4. L\xf6sungsstrategie",u={unversionedId:"architecture/Loesungsstrategie",id:"architecture/Loesungsstrategie",title:"4. L\xf6sungsstrategie",description:"Dieser Abschnitt enth\xe4lt einen stark verdichteten Architekturu\u0308berblick. Eine Gegenu\u0308berstellung der wichtigsten Ziele",source:"@site/docs/architecture/4_Loesungsstrategie.md",sourceDirName:"architecture",slug:"/architecture/Loesungsstrategie",permalink:"/docs/architecture/Loesungsstrategie",draft:!1,editUrl:"https://github.com/facebook/docusaurus/tree/main/packages/create-docusaurus/templates/shared/docs/architecture/4_Loesungsstrategie.md",tags:[],version:"current",sidebarPosition:4,frontMatter:{},sidebar:"tutorialSidebar",previous:{title:"3. Kontextabgrenzung",permalink:"/docs/architecture/Kontextabgrenzung"},next:{title:"5. Bausteinsicht",permalink:"/docs/architecture/Bausteinsicht"}},l={},o=[{value:"4.1 Einstieg in die L\xf6sungsstrategie",id:"41-einstieg-in-die-l\xf6sungsstrategie",level:2}],c={toc:o},p="wrapper";function g(e){let{components:t,...r}=e;return(0,i.kt)(p,(0,n.Z)({},c,r,{components:t,mdxType:"MDXLayout"}),(0,i.kt)("h1",{id:"4-l\xf6sungsstrategie"},"4. L\xf6sungsstrategie"),(0,i.kt)("p",null,"Dieser Abschnitt enth\xe4lt einen stark verdichteten Architekturu\u0308berblick. Eine Gegenu\u0308berstellung der wichtigsten Ziele\nund Lo\u0308sungsansa\u0308tze."),(0,i.kt)("h2",{id:"41-einstieg-in-die-l\xf6sungsstrategie"},"4.1 Einstieg in die L\xf6sungsstrategie"),(0,i.kt)("p",null,"Die folgende Tabelle stellt die Qualit\xe4tsziele von NerdBubble (siehe ",(0,i.kt)("a",{parentName:"p",href:"/docs/architecture/Einfuehrung_Ziele#12-qualittsziele"},"Abschnitt 1.2"),") passenden Architekturans\xe4tzen gegen\xfcber, und erleichtert\nso einen Einstieg in die L\xf6sung."),(0,i.kt)("table",null,(0,i.kt)("thead",{parentName:"table"},(0,i.kt)("tr",{parentName:"thead"},(0,i.kt)("th",{parentName:"tr",align:null},"Qualit\xe4tsziel"),(0,i.kt)("th",{parentName:"tr",align:null},"Dem zutr\xe4gliche Ans\xe4tze in der Architektur"))),(0,i.kt)("tbody",{parentName:"table"},(0,i.kt)("tr",{parentName:"tbody"},(0,i.kt)("td",{parentName:"tr",align:null},"Benutzbarkeit"),(0,i.kt)("td",{parentName:"tr",align:null},"- GUI ist Mobile First zu entwickeln")),(0,i.kt)("tr",{parentName:"tbody"},(0,i.kt)("td",{parentName:"tr",align:null},"Erweiterbarkeit"),(0,i.kt)("td",{parentName:"tr",align:null},"- Domain ist von dem Framework zu entkoppeln",(0,i.kt)("br",null)," - Frontend Umsetzung mit react.js",(0,i.kt)("br",null)," - API First Ansatz",(0,i.kt)("br",null)," - evolution\xe4re REST Full API zum Frontend")))))}g.isMDXComponent=!0}}]);