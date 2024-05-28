// @ts-check

/**
 * Build configuration
 *
 * @see {@link https://bud.js.org/guides/getting-started/configure}
 * @param {import('@roots/bud').Bud} app
 */
export default async (app) => {
  // console.log(app.hooks.all());
  app
    /**
     * Application entrypoints
     *
     * Paths are relative to your resources directory
     */
    .entry({
      app: {
        import: ['@scripts/app.js', '@styles/app.scss'],
        publicPath: '/app/themes/sage-theme/public/'
      },
    })

    .provide({
      jquery: ["jQuery", "$"],
    })
    
    /**
     * These files should be processed as part of the build
     * even if they are not explicitly imported in application assets.
     */

    .assets([
      {
        from: app.path('@src/images'),
        to: app.path('@dist/images'),
      },
      {
        from: app.path('@src/fonts'),
        to: app.path('@dist/fonts'),
      },
    ])

    /**
     * These files will trigger a full page reload
     * when modified.
     */
    .watch(["resources/views/**/*", "app/**/*"])

    /**
     * Target URL to be proxied by the dev server.
     *
     * This is your local dev server.
     */
    .proxy('http://sage-boiler.lndo.site')

    /**
     * Development URL
     */
    .serve('http://localhost:3000');

  // app.log(
  //   app.hooks.filter('build')
  // ).close()
};
