# Configuration

### Environment Variables

Out of the box Lima supports numerous configration options, some of which are required in order to run. Since Lima makes use of the dotenv package, any custom variables you add to your .env file will be available to you via `$_ENV`.

Below is a list of all supported variables and their requirement.

| Variable             | Required | Default Value | Description                                                                                       |
| -------------------- | -------- | ------------- | ------------------------------------------------------------------------------------------------- |
| DB_HOST              | Yes      |               | The database host                                                                                 |
| DB_NAME              | Yes      |               | The database name                                                                                 |
| DB_USER              | Yes      |               | The database user                                                                                 |
| DB_PASS              | Yes      |               | The database password                                                                             |
| DB_DEFAULT_LIMIT     | No       |               | The default limit to apply to SELECT database queries when no limit is specified within the query |
| LIMA_CONTROLLER_PATH | No       | Controllers   | The path your controller classes are located in relative to the app folder                        |
| LIMA_MODEL_PATH      | No       | Models        | The path your model classes are located in relative to the app folder                             |
| LIMA_TEMPLATE_DIR    | No       | views         | The path your template files are located in relative to your project root                         |
