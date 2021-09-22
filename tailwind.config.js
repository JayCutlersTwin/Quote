module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
        inset: {
            'calcModalFormTop': 'calc(50% - (390px / 2))',
            'calcModalFormLeft': 'calc(50% - (284px / 2))',
            'calcModalConfirmTop': 'calc(50% - (154px / 2))',
            'calcModalConfirmLeft': 'calc(50% - (354px / 2))',
        },
        margin: {
            'minusLeftDown': '-88px 0px 0px 0px',
            'confirmModalMargins': '-88px 0px 0px 0px',
        }
    },
  },
  variants: {
    extend: {
        padding: ['even']
    },
  },
  plugins: [],
}
