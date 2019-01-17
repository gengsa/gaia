import Vue from 'vue';
import VeeValidate from 'vee-validate';
import { kebabCase } from 'lodash';
import {
  Dialog,
  Loading,
  MessageBox,
  Checkbox,
  Radio,
  Switch,
  DatePicker,
} from 'element-ui';
import lang from 'element-ui/lib/locale/lang/en';
import locale from 'element-ui/lib/locale';
import 'element-ui/lib/theme-chalk/index.css';
import translate from './translate';
import { currencyExchange, currencyFormat } from './currency';
import myLoading from './loading';
import alert from './alert';
import Message from './message';

Vue.config.productionTip = false;
Vue.use(VeeValidate, {
  fieldsBagName: 'vee-fields',
});

Vue.use(Dialog);
Vue.use(Checkbox);
Vue.use(Radio);
Vue.use(Switch);
Vue.use(DatePicker);

Vue.filter('kebabCase', str => kebabCase(str));

Vue.prototype.translate = translate;
Vue.prototype.currencyExchange = currencyExchange;
Vue.prototype.currencyFormat = currencyFormat;

// element-ui
locale.use(lang);
Vue.use(Loading);
Vue.prototype.$loading = myLoading;
Vue.prototype.$message = Message;
Vue.prototype.$msgbox = MessageBox;
Vue.prototype.$alert = alert;
Vue.prototype.$confirm = MessageBox.confirm;
Vue.prototype.$prompt = MessageBox.prompt;

