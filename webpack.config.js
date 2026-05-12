const path = require('path');

module.exports = {
    mode: 'production',
    entry: {
        site: './build/js/site.js',
    },
    output: {
        filename: '[name].min.js',
        path: path.resolve(__dirname, 'public_html/assets/js'),
        clean: true,
    },
};
