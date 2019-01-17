import Vue from 'vue';
import DialogVue from 'element-ui/packages/dialog/src/component.vue';
// import { addClass, removeClass, getStyle } from 'element-ui/src/utils/dom';
// import { PopupManager } from 'element-ui/src/utils/popup';
// import afterLeave from 'element-ui/src/utils/after-leave';
import merge from 'element-ui/src/utils/merge';

// const DialogConstructor = Vue.extend(DialogVue);
const DialogConstructor = Vue.extend(DialogVue);

const defaults = {
  text: null,
  fullscreen: false,
  body: false,
  lock: false,
  customClass: '',
  title: '',
  modal: true,
  modalAppendToBody: true,
  appendToBody: true,
  lockScroll: true,
  closeOnClickModal: true,
  closeOnPressEscape: true,
  showClose: true,
  width: '', // string
  top: '15vh',
  beforeClose: null, // callback function
  center: false,
};

let dialogInstance;

// ??
// DialogConstructor.prototype.originalPosition = '';
// DialogConstructor.prototype.originalOverflow = '';

// DialogConstructor.prototype.close = function() {
//   if (this.fullscreen) {
//     dialogInstance = undefined;
//   }
//   afterLeave(this, _ => {
//     const target = this.fullscreen || this.body
//       ? document.body
//       : this.target;
//     removeClass(target, 'el-loading-parent--relative');
//     removeClass(target, 'el-loading-parent--hidden');
//     if (this.$el && this.$el.parentNode) {
//       this.$el.parentNode.removeChild(this.$el);
//     }
//     this.$destroy();
//   }, 300);
//   this.visible = false;
// };

// const addStyle = (options, parent, instance) => {
//   let maskStyle = {};
//   if (options.fullscreen) {
//     instance.originalPosition = getStyle(document.body, 'position');
//     instance.originalOverflow = getStyle(document.body, 'overflow');
//     maskStyle.zIndex = PopupManager.nextZIndex();
//   } else if (options.body) {
//     instance.originalPosition = getStyle(document.body, 'position');
//     ['top', 'left'].forEach(property => {
//       let scroll = property === 'top' ? 'scrollTop' : 'scrollLeft';
//       maskStyle[property] = options.target.getBoundingClientRect()[property] +
//         document.body[scroll] +
//         document.documentElement[scroll] +
//         'px';
//     });
//     ['height', 'width'].forEach(property => {
//       maskStyle[property] = options.target.getBoundingClientRect()[property] + 'px';
//     });
//   } else {
//     instance.originalPosition = getStyle(parent, 'position');
//   }
//   Object.keys(maskStyle).forEach(property => {
//     instance.$el.style[property] = maskStyle[property];
//   });
// };

const Dialog = (options = {}) => {
  if (Vue.prototype.$isServer) {
    return;
  }
  const ops = merge({}, defaults, options);
  // if (ty peof options.target === 'string') {
  //   options.target = document.querySelector(options.target);
  // }
  // options.target = options.target || document.body;
  // if (options.target !== document.body) {
  //   options.fullscreen = false;
  // } else {
  //   options.body = true;
  // }
  // if (options.fullscreen && dialogInstance) {
  //   return dialogInstance;
  // }

  // let parent = options.body ? document.body : options.target;
  const parent = document.body;
  const instance = new DialogConstructor({
    el: document.createElement('div'),
    propsData: ops,
  });
  instance.$on('update:visible', (isVisible) => {
    Vue.nextTick(() => {
      instance.visible = isVisible;
    });
  });
  // open, close, closed
  instance.$on('close', () => {
    Vue.nextTick(() => {
      instance.$destroy();
    });
  });
  // addStyle(options, parent, instance);
  // if (instance.originalPosition !== 'absolute' && instance.originalPosition !== 'fixed') {
  //   addClass(parent, 'el-loading-parent--relative');
  // }
  // if (options.fullscreen && options.lock) {
  //   addClass(parent, 'el-loading-parent--hidden');
  // }
  parent.appendChild(instance.$el);
  Vue.nextTick(() => {
    instance.visible = true;
  });
  // if (options.fullscreen) {
  dialogInstance = instance;
  window.dialogInstance = dialogInstance;
  instance.close = instance.hide;
  // }
  // return instance;
};


const close = () => {
  if (dialogInstance !== undefined) {
    dialogInstance.hide();
    dialogInstance = undefined;
  }
};

export default {
  open: Dialog,
  close,
};
