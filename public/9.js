(window.webpackJsonp=window.webpackJsonp||[]).push([[9],{Fgb4:function(e,t,n){"use strict";var r=n("vDqi"),a=n.n(r),i={DOMAIN_API:"https://127.0.0.2"},o=document.head.querySelector('meta[name="x-token"]');t.a=a.a.create({baseURL:"".concat(i.DOMAIN_API,"/api"),headers:{"Content-type":"application/json",Authorization:"Bearer ".concat(o.content)}})},H8ze:function(e,t,n){"use strict";var r=n("o0o1"),a=n.n(r),i=n("Fgb4");function o(e,t,n,r,a,i,o){try{var u=e[i](o),s=u.value}catch(e){return void n(e)}u.done?t(s):Promise.resolve(s).then(r,a)}function u(e){return function(){var t=this,n=arguments;return new Promise((function(r,a){var i=e.apply(t,n);function u(e){o(i,r,a,u,s,"next",e)}function s(e){o(i,r,a,u,s,"throw",e)}u(void 0)}))}}function s(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}var c=function(){function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e)}var t,n,r,o,c,l,f;return t=e,(n=[{key:"index",value:(f=u(a.a.mark((function e(){return a.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,i.a.get("/category");case 3:return e.abrupt("return",e.sent);case 6:e.prev=6,e.t0=e.catch(0),500===e.t0.response.status&&_vm.$router.push({name:"Logout"});case 10:case"end":return e.stop()}}),e,null,[[0,6]])}))),function(){return f.apply(this,arguments)})},{key:"show",value:function(e){}},{key:"create",value:(l=u(a.a.mark((function e(t){return a.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,i.a.post("/category",t);case 2:return e.abrupt("return",e.sent);case 3:case"end":return e.stop()}}),e)}))),function(e){return l.apply(this,arguments)})},{key:"update",value:(c=u(a.a.mark((function e(t){return a.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,i.a.put("/category/"+t.id,t);case 2:return e.abrupt("return",e.sent);case 3:case"end":return e.stop()}}),e)}))),function(e){return c.apply(this,arguments)})},{key:"destroy",value:(o=u(a.a.mark((function e(t){return a.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,i.a.delete("/category/".concat(t));case 2:return e.abrupt("return",e.sent);case 3:case"end":return e.stop()}}),e)}))),function(e){return o.apply(this,arguments)})}])&&s(t.prototype,n),r&&s(t,r),e}();t.a=new c},PrLf:function(e,t,n){"use strict";n.r(t);var r=n("o0o1"),a=n.n(r),i=n("L2JU"),o=n("H8ze"),u=n("Fgb4");function s(e,t,n,r,a,i,o){try{var u=e[i](o),s=u.value}catch(e){return void n(e)}u.done?t(s):Promise.resolve(s).then(r,a)}function c(e){return function(){var t=this,n=arguments;return new Promise((function(r,a){var i=e.apply(t,n);function o(e){s(i,r,a,o,u,"next",e)}function u(e){s(i,r,a,o,u,"throw",e)}o(void 0)}))}}function l(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}var f=new(function(){function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e)}var t,n,r,i,o,s,f;return t=e,(n=[{key:"index",value:(f=c(a.a.mark((function e(){return a.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,u.a.get("/posts");case 3:return e.abrupt("return",e.sent);case 6:e.prev=6,e.t0=e.catch(0),500===e.t0.response.status&&_vm.$router.push({name:"Logout"});case 10:case"end":return e.stop()}}),e,null,[[0,6]])}))),function(){return f.apply(this,arguments)})},{key:"show",value:function(e){}},{key:"create",value:(s=c(a.a.mark((function e(t){return a.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,u.a.post("/posts",t);case 2:return e.abrupt("return",e.sent);case 3:case"end":return e.stop()}}),e)}))),function(e){return s.apply(this,arguments)})},{key:"update",value:(o=c(a.a.mark((function e(t){var n;return a.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return n={title:t.title,content:t.content,thumbnail_id:t.thumbnail_id,meta_title:t.meta_title,meta_description:t.meta_description,meta_keywords:t.meta_keywords,tags:t.tags,keywords:t.keywords,param:t.param,publish:t.publish,category_id:t.category_id,updated_at:t.updated_at},e.next=3,u.a.put("/posts/"+t.id,n);case 3:return e.abrupt("return",e.sent);case 4:case"end":return e.stop()}}),e)}))),function(e){return o.apply(this,arguments)})},{key:"destroy",value:(i=c(a.a.mark((function e(t){return a.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,u.a.delete("/posts/".concat(t.id));case 2:return e.abrupt("return",e.sent);case 3:case"end":return e.stop()}}),e)}))),function(e){return i.apply(this,arguments)})}])&&l(t.prototype,n),r&&l(t,r),e}());function p(e){return function(e){if(Array.isArray(e))return d(e)}(e)||function(e){if("undefined"!=typeof Symbol&&Symbol.iterator in Object(e))return Array.from(e)}(e)||function(e,t){if(!e)return;if("string"==typeof e)return d(e,t);var n=Object.prototype.toString.call(e).slice(8,-1);"Object"===n&&e.constructor&&(n=e.constructor.name);if("Map"===n||"Set"===n)return Array.from(e);if("Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n))return d(e,t)}(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function d(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,r=new Array(t);n<t;n++)r[n]=e[n];return r}function h(e,t,n,r,a,i,o){try{var u=e[i](o),s=u.value}catch(e){return void n(e)}u.done?t(s):Promise.resolve(s).then(r,a)}function v(e){return function(){var t=this,n=arguments;return new Promise((function(r,a){var i=e.apply(t,n);function o(e){h(i,r,a,o,u,"next",e)}function u(e){h(i,r,a,o,u,"throw",e)}o(void 0)}))}}function m(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function b(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?m(Object(n),!0).forEach((function(t){g(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):m(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function g(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}var y={name:"Blog",data:function(){return{headers:[{sortable:!1,text:"ID",value:"id"},{sortable:!1,text:"Title",value:"title"},{sortable:!1,text:"Category",value:"category"},{sortable:!1,text:"Param",value:"param",align:"right"},{sortable:!1,text:"Thumbnail",value:"thumbnail",align:"center"},{sortable:!1,text:"Publish",value:"publish",align:"right"},{sortable:!1,text:"Updated at",value:"updated_at",align:"right"},{text:"Actions",value:"actions",sortable:!1,align:"right"}],fieldsLeft:[{icon:"fal fa-pen",title:"Contents",active:!0,items:[{title:"id",ref:"id",rules:[],required:!0,value:""},{title:"Titile",ref:"title",rules:[],required:!0,value:""},{title:"Content",isEditor:!0,ref:"content",value:""}]},{icon:"fal fa-book-reader",title:"Meta Seo",items:[{title:"Meta title",ref:"meta_title",rules:[],required:!0,value:""},{title:"Meta description",ref:"meta_description",rules:[],required:!0,value:""},{title:"Meta keywords",ref:"meta_keywords",rules:[],required:!0,value:""},{title:"Param",ref:"param",rules:[],required:!0,value:""}]}],category:{categorySelected:{},items:[]},thumbnail:{},publish:!0,items:[],isLoading:!0,openDialog:!1,editIndex:-1,newItem:{},sheet:{opentSheet:!1,message:""}}},computed:b(b({},Object(i.c)(["categories"])),{},{heading:function(){return-1===this.editIndex?"New Blog":"Edit Blog"}}),methods:b(b({},Object(i.b)({setCategories:"SET_CATEGORIES"})),{},{editItem:function(e){this.openDialog=!0,this.editIndex=this.items.findIndex((function(t){return t.title==e.title})),this.fieldsLeft.forEach((function(t){t.items.forEach((function(t){t.value=e[t.ref]}))})),this.category.categorySelected=e.category,this.thumbnail=b({},e.thumbnail),this.publish=1===e.publish},onSave:function(e){var t=this;return v(a.a.mark((function n(){return a.a.wrap((function(n){for(;;)switch(n.prev=n.next){case 0:if(e.thumbnail_id=e.thumbnail.id,e.category_id="number"==typeof e.category?e.category:e.category.id,!(t.editIndex>-1)){n.next=7;break}return n.next=5,f.update(e).then((function(e){var n=e.data.data;Object.assign(t.items[t.editIndex],n)}));case 5:n.next=9;break;case 7:return n.next=9,f.create(e).then((function(e){var n=e.data.data;t.items.unshift(n)}));case 9:t.openDialog=!1,t.editIndex=-1;case 11:case"end":return n.stop()}}),n)})))()},getMaxDate:function(){this.newItem=this.items.reduce((function(e,t){return new Date(e.created_at)>new Date(t.created_at)?e:t}))},deleteItem:function(e){var t=this;return v(a.a.mark((function n(){var r;return a.a.wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return n.next=2,t.items.findIndex((function(t){return t.title==e.title}));case 2:if(!((r=n.sent)>-1)){n.next=6;break}return n.next=6,f.destroy(e).then((function(e){var n=e.data.message;t.items.splice(r,1),t.sheet.opentSheet=!0,t.sheet.message=n}));case 6:case"end":return n.stop()}}),n)})))()}}),mounted:function(){var e=this;return v(a.a.mark((function t(){return a.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,f.index().then((function(t){var n=t.data.data;e.items=n,e.isLoading=!1}));case 2:if(e.categories.blog){t.next=7;break}return t.next=5,o.a.index().then((function(t){var n=t.data.data;e.setCategories(b(b({},e.categories),{},{blog:n})),e.category.items=p(n)}));case 5:t.next=8;break;case 7:e.category.items=p(e.categories.blog);case 8:e.getMaxDate();case 9:case"end":return t.stop()}}),t)})))()}},w=n("KHd+"),x=Object(w.a)(y,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("v-container",[n("base-material-card",{staticClass:"px-5 py-10",attrs:{color:"warning"},scopedSlots:e._u([{key:"heading",fn:function(){return[n("div",{staticClass:"display-2 font-weight-light"},[e._v(e._s(e.newItem.title))]),e._v(" "),n("div",{staticClass:"subtitle-1 font-weight-light"},[e._v("New blog on "+e._s(new Date(e.newItem.created_at).toDateString()))]),e._v(" "),n("v-spacer",{staticClass:"py-3"}),e._v(" "),n("base-dialogs-form",{attrs:{heading:e.heading,openDialog:e.openDialog,fieldsLeft:e.fieldsLeft,category:e.category,thumbnail:e.thumbnail,publish:e.publish,editIndex:e.editIndex},on:{"update:openDialog":function(t){e.openDialog=t},"update:open-dialog":function(t){e.openDialog=t},"update:thumbnail":function(t){e.thumbnail=t},"update:publish":function(t){e.publish=t},"update:editIndex":function(t){e.editIndex=t},"update:edit-index":function(t){e.editIndex=t},save:e.onSave}})]},proxy:!0}])},[e._v(" "),n("v-card-text",[n("v-data-table",{attrs:{loading:e.isLoading,headers:e.headers,items:e.items},scopedSlots:e._u([{key:"item.updated_at",fn:function(t){var n=t.item;return[e._v(e._s(new Date(n.updated_at).toLocaleString()))]}},{key:"item.thumbnail",fn:function(e){var t=e.item;return[n("v-img",{staticClass:"m-auto",attrs:{src:"/assets/"+t.thumbnail.name,width:"100"}})]}},{key:"item.category",fn:function(t){var n=t.item;return[e._v(e._s(n.category?n.category.name:""))]}},{key:"item.publish",fn:function(t){var n=t.item;return[e._v(e._s(1==n.publish))]}},{key:"item.actions",fn:function(t){var r=t.item;return[n("v-icon",{staticClass:"mr-2",attrs:{small:""},on:{click:function(t){return e.editItem(r)}}},[e._v("fal fa-pencil")]),e._v(" "),n("v-icon",{attrs:{small:""},on:{click:function(t){return e.deleteItem(r)}}},[e._v("fal fa-trash-alt")])]}}])})],1)],1),e._v(" "),n("base-bottom-sheet",{attrs:{opentSheet:e.sheet.opentSheet,message:e.sheet.message},on:{"update:opentSheet":function(t){return e.$set(e.sheet,"opentSheet",t)},"update:opent-sheet":function(t){return e.$set(e.sheet,"opentSheet",t)}}})],1)}),[],!1,null,null,null);t.default=x.exports}}]);
//# sourceMappingURL=9.js.map