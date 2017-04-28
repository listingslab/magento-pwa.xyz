/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

'use strict';

module.exports = {
    file: {
        options: {
            config: 'dev/tests/static/testsuite/Magento/Test/Js/_files/jscs/.jscsrc'
        },
        src: ''
    },
    test: {
        options: {
            config: 'dev/tests/static/testsuite/Magento/Test/Js/_files/jscs/.jscsrc',
            reporterOutput: 'dev/tests/static/jscs-error-report.xml',
            reporter: 'junit'
        },
        src: ''
    }
};
