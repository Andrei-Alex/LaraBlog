import { defineConfig } from 'cypress';

export default defineConfig({
  e2e: {
    supportFile: false,
    setupNodeEvents(on, config) {},
  },
  component: {
    supportFile: false,
    devServer: {
      framework: 'next',
      bundler: 'webpack',
    },
    specPattern: 'cypress/component/**/*.cy.{js,jsx,ts,tsx}',
  },
});
