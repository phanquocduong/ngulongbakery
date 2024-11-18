function Validator(formSelector) {
    const _this = this;

    const getParent = (element, selector) => {
        while (element.parentElement) {
            if (element.parentElement.matches(selector)) {
                return element.parentElement;
            }
            element = element.parentElement;
        }
    };

    const formRules = {};

    // Quy ước tạo rule:
    const validatorRules = {
        required: value => (value ? undefined : 'Bạn chưa nhập thông tin này!'),
        email: value => {
            const regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return regex.test(value) ? undefined : 'Email không đúng định dạng!';
        },
        min: min => value => value.length >= min ? undefined : `Vui lòng nhập ít nhất ${min} ký tự!`,
        passwordComplexity: value => {
            const lowerCase = /[a-z]/.test(value);
            const upperCase = /[A-Z]/.test(value);
            const number = /[0-9]/.test(value);
            const specialChar = /[!@#$%^&*(),.?":{}|<>]/.test(value);
            return lowerCase && upperCase && number && specialChar
                ? undefined
                : 'Mật khẩu phải chứa chữ hoa, chữ thường, số và ký tự đặc biệt!';
        }
    };

    // Lấy ra form element trong DOM theo `formSelector`
    const formElement = document.querySelector(formSelector);

    // Hàm thực hiện validate
    const handleValidate = event => {
        const rules = formRules[event.target.name];
        let errorMessage;

        for (const rule of rules) {
            errorMessage = rule(event.target.value);
            if (errorMessage) {
                const formGroup = getParent(event.target, '.form-group');
                if (formGroup) {
                    const formMessage = formGroup.querySelector('.form-message');
                    if (formMessage) {
                        formMessage.innerText = errorMessage;
                    }
                }
                break;
            }
        }
        return !errorMessage;
    };

    // Hàm clear message lỗi
    const handleClearError = event => {
        const formGroup = getParent(event.target, '.form-group');
        if (formGroup) {
            const formMessage = formGroup.querySelector('.form-message');
            if (formMessage) {
                formMessage.innerText = '';
            }
        }
    };

    // Chỉ xử lý khi có element trong DOM
    if (formElement) {
        const inputs = formElement.querySelectorAll('[name][rules]');

        inputs.forEach(input => {
            const rules = input.getAttribute('rules').split('|');

            rules.forEach(rule => {
                const isRuleHasValue = rule.includes(':');
                let ruleFunc = validatorRules[rule];

                if (isRuleHasValue) {
                    const [ruleName, ruleValue] = rule.split(':');
                    ruleFunc = validatorRules[ruleName](ruleValue);
                }

                if (Array.isArray(formRules[input.name])) {
                    formRules[input.name].push(ruleFunc);
                } else {
                    formRules[input.name] = [ruleFunc];
                }
            });

            // Lắng nghe sự kiện để validate (blur, change)
            input.onblur = handleValidate;
            input.oninput = handleClearError;
        });

        // Xử lí hành vi submit form
        formElement.onsubmit = event => {
            event.preventDefault();
            const inputs = formElement.querySelectorAll('[name][rules]');
            let isValid = true;

            inputs.forEach(input => {
                if (!handleValidate({ target: input })) {
                    isValid = false;
                }
            });

            // Khi không có lỗi thì submit form
            if (isValid) {
                if (typeof _this.onSubmit === 'function') {
                    const enableInputs = formElement.querySelectorAll('[name]:not([disabled])');
                    const formValues = Array.from(enableInputs).reduce((values, input) => {
                        switch (input.type) {
                            case 'radio':
                                values[input.name] = formElement.querySelector(
                                    `input[name="${input.name}"]:checked`
                                ).value;
                                break;
                            case 'checkbox':
                                if (!input.matches(':checked')) {
                                    values[input.name] = '';
                                    return values;
                                }
                                if (!Array.isArray(values[input.name])) {
                                    values[input.name] = [];
                                }
                                values[input.name].push(input.value);
                                break;
                            case 'file':
                                values[input.name] = input.files;
                                break;
                            default:
                                values[input.name] = input.value;
                        }
                        return values;
                    }, {});

                    // Gọi lại làm onSubmit và trả về kèm giá trị của form
                    _this.onSubmit(formValues);
                } else {
                    formElement.submit();
                }
            }
        };
    }
}
