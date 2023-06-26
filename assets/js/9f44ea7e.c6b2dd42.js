"use strict";(self.webpackChunkdoku=self.webpackChunkdoku||[]).push([[2772],{3905:(e,t,r)=>{r.d(t,{Zo:()=>s,kt:()=>m});var n=r(7294);function a(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}function i(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function c(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?i(Object(r),!0).forEach((function(t){a(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):i(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}function o(e,t){if(null==e)return{};var r,n,a=function(e,t){if(null==e)return{};var r,n,a={},i=Object.keys(e);for(n=0;n<i.length;n++)r=i[n],t.indexOf(r)>=0||(a[r]=e[r]);return a}(e,t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(e);for(n=0;n<i.length;n++)r=i[n],t.indexOf(r)>=0||Object.prototype.propertyIsEnumerable.call(e,r)&&(a[r]=e[r])}return a}var l=n.createContext({}),u=function(e){var t=n.useContext(l),r=t;return e&&(r="function"==typeof e?e(t):c(c({},t),e)),r},s=function(e){var t=u(e.components);return n.createElement(l.Provider,{value:t},e.children)},p="mdxType",d={inlineCode:"code",wrapper:function(e){var t=e.children;return n.createElement(n.Fragment,{},t)}},b=n.forwardRef((function(e,t){var r=e.components,a=e.mdxType,i=e.originalType,l=e.parentName,s=o(e,["components","mdxType","originalType","parentName"]),p=u(r),b=a,m=p["".concat(l,".").concat(b)]||p[b]||d[b]||i;return r?n.createElement(m,c(c({ref:t},s),{},{components:r})):n.createElement(m,c({ref:t},s))}));function m(e,t){var r=arguments,a=t&&t.mdxType;if("string"==typeof e||a){var i=r.length,c=new Array(i);c[0]=b;var o={};for(var l in t)hasOwnProperty.call(t,l)&&(o[l]=t[l]);o.originalType=e,o[p]="string"==typeof e?e:a,c[1]=o;for(var u=2;u<i;u++)c[u]=r[u];return n.createElement.apply(null,c)}return n.createElement.apply(null,r)}b.displayName="MDXCreateElement"},3186:(e,t,r)=>{r.r(t),r.d(t,{assets:()=>l,contentTitle:()=>c,default:()=>d,frontMatter:()=>i,metadata:()=>o,toc:()=>u});var n=r(7462),a=(r(7294),r(3905));const i={},c="5. Bausteinsicht",o={unversionedId:"architecture/Bausteinsicht",id:"architecture/Bausteinsicht",title:"5. Bausteinsicht",description:"Dieser Abschnitt beschreibt die Zerlegung von NerdBubble in Services. Jeder Service wird als FaaS bereitgestellt.",source:"@site/docs/architecture/5_Bausteinsicht.md",sourceDirName:"architecture",slug:"/architecture/Bausteinsicht",permalink:"/docs/architecture/Bausteinsicht",draft:!1,editUrl:"https://github.com/facebook/docusaurus/tree/main/packages/create-docusaurus/templates/shared/docs/architecture/5_Bausteinsicht.md",tags:[],version:"current",sidebarPosition:5,frontMatter:{},sidebar:"tutorialSidebar",previous:{title:"4. L\xf6sungsstrategie",permalink:"/docs/architecture/Loesungsstrategie"},next:{title:"6. Laufzeitsicht",permalink:"/docs/architecture/Laufzeitsicht"}},l={},u=[],s={toc:u},p="wrapper";function d(e){let{components:t,...r}=e;return(0,a.kt)(p,(0,n.Z)({},s,r,{components:t,mdxType:"MDXLayout"}),(0,a.kt)("h1",{id:"5-bausteinsicht"},"5. Bausteinsicht"),(0,a.kt)("p",null,"Dieser Abschnitt beschreibt die Zerlegung von NerdBubble in Services. Jeder Service wird als FaaS bereitgestellt."),(0,a.kt)("mermaid",{value:'C4Context\n    Container_Boundary(neadBubble, "NerdBubble") {\n        Component(app, "App")\n        Component(newsStreamApi, "News Stream API")\n        Component(crawler, "Crawler")\n\n        ContainerDb(db, "Database")\n    }\n    \n    System_Ext(newsProvider, "Neuigkeiten Anbieter")\n    \n    Rel(app, newsStreamApi, "")\n    Rel(newsStreamApi, db, "")\n    Rel(crawler, db, "")\n    Rel(crawler, newsProvider, "")\n\n    UpdateLayoutConfig($c4ShapeInRow="3", $c4BoundaryInRow="1")'}),(0,a.kt)("table",null,(0,a.kt)("thead",{parentName:"table"},(0,a.kt)("tr",{parentName:"thead"},(0,a.kt)("th",{parentName:"tr",align:null},"Module"),(0,a.kt)("th",{parentName:"tr",align:null},"Kurzbeschreibung"))),(0,a.kt)("tbody",{parentName:"table"},(0,a.kt)("tr",{parentName:"tbody"},(0,a.kt)("td",{parentName:"tr",align:null},"App"),(0,a.kt)("td",{parentName:"tr",align:null},"Native Mobile App")),(0,a.kt)("tr",{parentName:"tbody"},(0,a.kt)("td",{parentName:"tr",align:null},"News Stream API"),(0,a.kt)("td",{parentName:"tr",align:null},"Rest API zum laden aller Neuigkeiten")),(0,a.kt)("tr",{parentName:"tbody"},(0,a.kt)("td",{parentName:"tr",align:null},"crawler"),(0,a.kt)("td",{parentName:"tr",align:null},"Service welcher die Daten eines Neuigkeiten Anbieter l\xe4dt und aufarbeitet")))))}d.isMDXComponent=!0}}]);