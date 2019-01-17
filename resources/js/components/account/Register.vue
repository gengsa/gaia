<template>
  <div class="login_regist container middle-box">
    <div class="form_box">
      <form action="" class="verify_box" autocomplete="off">
        <div class="form_title">
          <span class="title">{{ translate('member_register') }}</span>
          <span class="go_login">{{ translate('member_has_account') }}
            <a :href="`${urlPrefix}/account/login?returnUrl=${encodeURIComponent(returnUrl)}`">
              {{ translate('cart_sign_in') }}
            </a>
          </span>
        </div>
        <p class="help_des">{{ translate('member_before_register_tips') }}</p>
        <p v-if="hasError" class="v_tips"><i class="icon-warning"/> {{ errTips }}</p>
        <div class="regisinfo_block">
          <h3>{{ translate('member_account_info') }}</h3>
          <ul>
            <li :class="{ v_error: errors.has('login_name') }">
              <input v-validate="formValid.login_name"
                     v-model="member.login_name"
                     :class="{ v_info: true, v_active: member.login_name != '' || formFocus.login_name }"
                     name="login_name"
                     type="text"
                     @focus="formFocus.login_name = true"
                     @blur="formFocus.login_name = false">
              <p class="placetips">{{ translate('member_user_name') }}*</p>
              <p class="error_tips">{{ errors.first('login_name') }}</p>
              <i class="icon-warning"/>
            </li>
            <li :class="{ v_error: errors.has('email') }">
              <input v-validate="formValid.email"
                     v-model="member.email"
                     :class="{ v_info: true, v_active: member.email != '' || formFocus.email }"
                     name="email"
                     type="text"
                     @focus="formFocus.email = true"
                     @blur="formFocus.email = false">
              <p class="placetips">{{ translate('member_email') }}*</p>
              <p class="error_tips">{{ errors.first('email') }}</p>
              <i class="icon-warning"/>
            </li>
            <li :class="{ v_error: errors.has('password') }">
              <input v-validate="formValid.password"
                     v-model="member.password"
                     :class="{ v_info: true, v_active: member.password != '' || formFocus.password }"
                     :type="showPwd ? 'text' : 'password'"
                     name="password"
                     @focus="formFocus.password = true"
                     @blur="formFocus.password = false">
              <p class="placetips">{{ translate('member_password_tips') }}*</p>
              <span class="pass_state" @click="showPwd = !showPwd">
                {{ translate(showPwd ? 'common_hide' : 'common_show') }}
              </span>
              <p class="error_tips">{{ errors.first('password') }}</p>
              <i class="icon-warning"/>
            </li>
            <li :class="{ v_error: errors.has('password_confirmation') }">
              <input v-validate="formValid.password_confirmation"
                     v-model="member.password_confirmation"
                     :class="{ v_info: true,
                               v_active: member.password_confirmation != '' || formFocus.password_confirmation }"
                     :type="showConfirmPwd ? 'text' : 'password'"
                     name="password_confirmation"
                     @focus="formFocus.password_confirmation = true"
                     @blur="formFocus.password_confirmation = false">
              <p class="placetips">{{ translate('member_confirm_password') }}*</p>
              <span class="pass_state" @click="showConfirmPwd = !showConfirmPwd">
                {{ translate(showConfirmPwd ? 'common_hide' : 'common_show') }}
              </span>
              <p class="error_tips">{{ errors.first('password_confirmation') }}</p>
              <i class="icon-warning"/>
            </li>
          </ul>
        </div>
        <div class="regisinfo_block">
          <h3>{{ translate('member_personal_info') }}</h3>
          <ul>
            <li class="clear">
              <div :class="{ v_error: errors.has('first_name') }" class="user_item">
                <input v-validate="formValid.first_name"
                       v-model="member.first_name"
                       :class="{v_info: true, v_active: member.first_name != '' || formFocus.first_name}"
                       name="first_name"
                       type="text"
                       @focus="formFocus.first_name = true"
                       @blur="formFocus.first_name = false">
                <p class="placetips">{{ translate('common_first_name') }}*</p>
                <p class="error_tips">{{ errors.first('first_name') }}</p>
                <i class="icon-warning"/>
              </div>
              <div :class="{ v_error: errors.has('last_name') }" class="user_item">
                <input v-validate="formValid.last_name"
                       v-model="member.last_name"
                       :class="{v_info: true, v_active: member.last_name != '' || formFocus.last_name}"
                       name="last_name"
                       type="text"
                       @focus="formFocus.last_name = true"
                       @blur="formFocus.last_name = false">
                <p class="placetips">{{ translate('common_last_name') }}*</p>
                <p class="error_tips">{{ errors.first('last_name') }}</p>
                <i class="icon-warning"/>
              </div>
            </li>
            <li :class="{ v_error: errors.has('phone') }">
              <input v-validate="formValid.phone"
                     v-model="member.phone"
                     :class="{ v_info: true, v_active: member.phone != '' || formFocus.phone }"
                     name="phone"
                     type="text"
                     @focus="formFocus.phone = true"
                     @blur="formFocus.phone = false">
              <p class="placetips">{{ translate('common_phone') }}*</p>
              <p class="error_tips">{{ errors.first('phone') }}</p>
              <i class="icon-warning"/>
            </li>
            <li :class="{v_error: errors.has('country')}">
              <select v-validate="formValid.country"
                      v-model="member.country"
                      :class="{ v_info: true, v_active: member.country != '' || formFocus.country }"
                      name="country"
                      @focus="formFocus.country = true"
                      @blur="formFocus.country = false" @change="changeRegion">
                <option value=""/>
                <option v-for="item in regions"
                        :key="item.id"
                        :value="item.id">
                  {{ item.local_name }}
                </option>
              </select>
              <p class="placetips">{{ translate('checkout_country') }}*</p>
              <i class="icon-angle-down"/>
              <p class="error_tips">{{ errors.first('country') }}</p>
              <i class="icon-warning"/>
            </li>
          </ul>
        </div>
        <div class="regisinfo_block">
          <ul>
            <li :class="{ v_error: errors.has('captcha') }">
              <input v-validate="formValid.captcha"
                     v-model="member.captcha"
                     :class="{ v_info: true, v_active: member.captcha != '' || formFocus.captcha }"
                     name="captcha"
                     type="text"
                     @focus="formFocus.captcha = true"
                     @blur="formFocus.captcha = false">
              <p class="placetips">{{ translate('common_verify_code') }}*</p>
              <img :src="`/captcha/default?1`"
                   ref="captcha"
                   onclick="this.src = this.src + Math.random().toString(36).substr(2, 1)"
                   alt=""
                   class="code_img">
              <i class="icon-warning"/>
              <p class="error_tips">{{ errors.first('captcha') }}</p>
            </li>
            <li>
              <div>
                <button class="c-btn btn_ok" @click.prevent="register">{{ translate('member_register') }}</button>
              </div>
            </li>
            <li class="help_des">
              <p>
                <span v-html="translate('member_register_tips')"/>
              </p>
              <p>
                {{ translate('member_register_notice') }}
              </p>
            </li>
          </ul>
        </div>
      </form>
    </div>

    <el-dialog
      :visible.sync="dialogVisible"
      :show-close="false"
      width="360px">
      <div class="alert_dialog">
        <div class="choose_info">
          <p v-html="infoContent"/>
        </div>
        <div class="btn_opera">
          <button class="c-btn btn-style-3" @click="confirmDialog">
            {{ translate('common_ok') }}
          </button>
        </div>
      </div>
    </el-dialog>
  </div>
</template>

<script>
import axios from 'axios';
import { scrollTo } from '../../common/scrollTo';

export default {
  props: {
    returnUrl: {
      type: String,
      default: '',
    },
    urlPrefix: {
      type: String,
      default: '',
    },
  },
  data() {
    return {
      dialogVisible: false,
      infoContent: this.translate('member_after_register_tips'),
      hasError: false,
      errTips: '',
      showPwd: false,
      showConfirmPwd: false,
      regions: window.pageData.countryList,
      provinceList: [],
      member: {
        login_name: '',
        email: '',
        password: '',
        password_confirmation: '',
        country: '',
        phone: '',
        captcha: '',
        first_name: '',
        last_name: '',
      },
      formFocus: {
        login_name: false,
        email: false,
        password: false,
        password_confirmation: false,
        country: false,
        phone: false,
        captcha: false,
        first_name: false,
        last_name: false,
      },
      formValid: {
        login_name: {
          required: true,
          min: 6,
          max: 20,
          regex: /^[0-9a-zA-Z]+$/,
        },
        email: {
          required: true,
          email: true,
        },
        password: {
          required: true,
          min: 8,
          max: 20,
          regex: /^[a-zA-Z0-9.@#$%^&*()[\]\\?\\/|\-~`!+=,\r\n:;'"]*$/,
          validPassword: true,
        },
        password_confirmation: {
          required: true,
          confirmed: 'password',
        },
        phone: {
          required: true,
          max: 20,
          regex: /^([+][0-9]{1,3}([ .-])?)?([(][0-9]{1,6}[)])?([0-9 .-]{1,32})(([A-Za-z :]{1,11})?[0-9]{1,4}?)$/,
        },
        captcha: {
          required: true,
          min: 4,
        },
        first_name: {
          required: true,
          regex: /^[A-Za-z0-9!@#&()_+-<>:,./;"' ]+$/,
        },
        last_name: {
          required: true,
          regex: /^[A-Za-z0-9!@#&()_+-<>:,./;"' ]+$/,
        },
        country: {
          required: true,
        },
      },
    };
  },
  computed: {
  },
  created() {
    this.$validator.extend('validPassword', {
      getMessage: () => this.translate('validate_register_password_rule'),
      validate: value => (/[a-z]/.test(value) && /[A-Z]/.test(value) && /[0-9]/.test(value)),
    });
    const dict = {
      custom: {
        login_name: {
          required: this.translate('member_enter_user_name'),
          regex: this.translate('validate_invalid_no_special_characters'),
          min: this.translate('common_min_tips', {
            field: this.translate('member_user_name'),
            num: 6,
          }),
          max: this.translate('common_max_tips', {
            field: this.translate('member_user_name'),
            num: 20,
          }),
        },

        email: {
          required: this.translate('member_enter_email'),
          regex: this.translate('validate_invalid_email_address'),
        },
        password: {
          required: this.translate('member_please_enter_password'),
          regex: this.translate('validate_register_password_rule2'),
          min: this.translate('common_min_tips', {
            field: this.translate('member_password'),
            num: 8,
          }),
          max: this.translate('common_max_tips', {
            field: this.translate('member_password'),
            num: 20,
          }),
        },
        password_confirmation: {
          required: this.translate('member_password_inconsistent'),
          confirmed: this.translate('member_password_inconsistent'),
        },
        phone: {
          required: this.translate('checkout_phone_required'),
          regex: this.translate('validate_phone_number'),
          max: this.translate('common_max_tips', {
            field: this.translate('common_phone'),
            num: 20,
          }),
        },
        country: {
          required: this.translate('checkout_country_required'),
        },
        captcha: {
          required: this.translate('member_please_enter_verify_code'),
          min: this.translate('common_min_tips', {
            field: this.translate('common_verify_code'),
            num: 4,
          }),
        },
        first_name: {
          required: this.translate('checkout_first_name_required'),
          regex: this.translate('validate_invalid_first_name'),
        },
        last_name: {
          required: this.translate('checkout_last_name_required'),
          regex: this.translate('validate_invalid_last_name'),
        },
      },
    };
    this.$validator.localize('en', dict);
  },
  methods: {
    createMember(callback) {
      const self = this;
      axios.post('/account/register', this.member).then((response) => {
          self.hasError = false;
          callback();
      }).catch((err) => {
        const data = err.response.data;
        self.hasError = true;
        self.errTips = data.message;
        scrollTo();
        this.$refs.captcha.click();
      });
    },
    register() {
      const self = this;
      this.$validator.validate().then((result) => {
        if (result) {
          this.createMember(() => {
            self.dialogVisible = true;
          });
        }
        return false;
      });
    },
    confirmDialog() {
      window.location.href = this.returnUrl;
    },
  },
};
</script>
