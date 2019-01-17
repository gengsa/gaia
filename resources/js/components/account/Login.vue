<template>
  <div class="login_regist container">
    <div class="form_box">
      <form class="verify_box">
        <div class="form_title">
          <span class="title">{{ translate('cart_sign_in') }}</span>
          <span class="go_regis">{{ translate('member_do_not_have_account') }}
            <a :href="`/account/register?returnUrl=${encodeURIComponent(returnUrl)}`">
              {{ translate('member_register') }}
            </a>
          </span>
        </div>
        <div class="verify_cons">
          <p v-if="hasError" class="v_tips"><i class="icon-warning"/>{{ translate('validate_login_error') }}</p>
          <ul>
            <li class="">
              <input v-model="loginName"
                     :class="{ v_info: true, v_active: loginName !== '' || focusLoginName }"
                     type="text"
                     @focus="focusLoginName = true"
                     @blur="focusLoginName = false">
              <p class="placetips">{{ translate('member_username_or_email') }}</p>
            </li>
            <li>
              <input v-model="password"
                     :class="{ v_info: true, v_active: password !== '' || focusPassword }"
                     :type="showPwd ? 'text' : 'password'"
                     @focus="focusPassword = true"
                     @blur="focusPassword = false">
              <p class="placetips">{{ translate('member_password') }}</p>
              <span class="pass_state" @click="showPwd = !showPwd">
                {{ translate(showPwd ? 'common_hide' : 'common_show') }}
              </span>
            </li>
            <li>
              <input v-model="verifyCode"
                     :class="{ v_info: true, v_active: verifyCode !== '' || focusVerifyCode }"
                     type="text"
                     @focus="focusVerifyCode = true"
                     @blur="focusVerifyCode = false">
              <p class="placetips">{{ translate('common_verify_code') }}</p>
              <img :src="`/captcha/default?1`"
                   ref="captcha"
                   onclick="this.src = this.src + Math.random().toString(36).substr(2, 1)"
                   alt=""
                   class="code_img">
            </li>
            <li class="sign_forget">
              <input type="checkbox" checked>
              &nbsp;&nbsp;{{ translate('member_stay_signed_in') }}
              <a :href="`/account/forgetPassword`"
                 class="forget_pass">
                {{ translate('member_forgot_your_password') }}
              </a>
            </li>
            <li>
              <div :class="{ disabled: disableStatus }">
                <button type="button" class="c-btn btn_ok" @click="login">{{ translate('cart_sign_in') }}</button>
                <div class="btn_mask"/>
              </div>
            </li>
          </ul>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      returnUrl: window.pageData.returnUrl,
      loginName: '',
      password: '',
      verifyCode: '',
      focusLoginName: false,
      focusPassword: false,
      focusVerifyCode: false,
      hasError: false,
      showPwd: false,
    };
  },
  computed: {
    disableStatus() {
      let status = false;
      if (!this.loginName || !this.password || !this.verifyCode) {
        status = true;
      }
      return status;
    },
  },
  methods: {
    login() {
      this.hasError = false;
      if (this.loginName === '' || this.password === '' || this.verifyCode === '') {
        this.hasError = true;
        return;
      }
      axios.post('/account/login', {
        username: this.loginName,
        password: this.password,
        captcha: this.verifyCode,
      }).then((response) => {
        const data = response.data;
        if (data.status === 0) {
          window.location.href = this.returnUrl;
        } else {
          this.hasError = true;
          this.$refs.captcha.click();
        }
      }).catch((err) => {
        this.hasError = true;
        this.$refs.captcha.click();
      });
    },
  },
};
</script>
