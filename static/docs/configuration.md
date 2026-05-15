# Configuration

<a id="environment-variables"></a>

### Environment Variables

Out of the box Lima supports numerous configuration options, some of which are required in order to run. Since Lima makes use of the dotenv package, any custom variables you add to your .env file will be available to you via `$_ENV`.

Below is a list of all supported variables and their requirement.

| Variable             | Required | Default Value | Description                                                                                                                                        |
| -------------------- | -------- | ------------- | -------------------------------------------------------------------------------------------------------------------------------------------------- |
| DB_ENGINE            | No       | mysql         | The engine used for the database. Set to "off" to disable DB communication and requirement entirely                                                |
| DB_HOST              | Yes/No   |               | The database host. This is only required if DB_ENGINE is set to "mysql".                                                                           |
| DB_NAME              | Yes/No   |               | The database name. This is only required if DB_ENGINE is set to "mysql".                                                                           |
| DB_USER              | Yes/No   |               | The database user. This is only required if DB_ENGINE is set to "mysql".                                                                           |
| DB_PASS              | Yes/No   |               | The database password. This is only required if DB_ENGINE is set to "mysql".                                                                       |
| DB_DEFAULT_LIMIT     | No       |               | The default limit to apply to SELECT database queries when no limit is specified within the query. This won't apply when DB_ENGINE is set to "off" |
| LIMA_CONTROLLER_PATH | No       | Controllers   | The path your controller classes are located in relative to the app folder                                                                         |
| LIMA_MODEL_PATH      | No       | Models        | The path your model classes are located in relative to the app folder                                                                              |
| LIMA_TEMPLATE_DIR    | No       | views         | The path your template files are located in relative to your project root                                                                          |
