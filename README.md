# POC job2job-move-output-to-input

Build https://github.com/keboola/job2job-move-output-to-input/actions

## Development
 
Clone this repository and init the workspace with following command:

```
git clone git@github.com:keboola/job2job-move-output-to-input.git
cd job2job-move-output-to-input
docker-compose build
docker-compose run --rm dev composer install --no-scripts
```

Run the test suite using this command:

```
docker-compose run --rm dev composer tests
```
 
# Integration

For information about deployment and integration with KBC, please refer to the [deployment section of developers documentation](https://developers.keboola.com/extend/component/deployment/) 

## License

MIT licensed, see [LICENSE](./LICENSE) file.
