# Initialize Sequelize: 
npm install --save sequelize

# Example Table
Country	PhoneCode	Capital	IndependenceYear
Afghanistan	93	Kabul	1919
Belarus	375	Misk	1991
Netherlands	31	Amsterdam	1648
Oman	968	Muscat	1970
Zambia	260	Lusaka	1964

# Create Model with Sequelize:

var tableName = sequelize.define('tableName', {
  Country: {
    type: Sequelize.STRING
  },
  PhoneCode: {
    type: Sequelize.INTEGER
  },
  Capital: {
    type: Sequelize.STRING
  },
  IndependenceYear: {
    type: Sequelize.INTEGER
  },
},
{
  freezeTableName: true // Model tableName will be the same as the model name instead of being pluralized
});

// force: true will drop the table if it already exists
tableName.sync({force: true}).then(function () {
  // Table created
  return tableName.create({
    Country: 'Afghanistan',
    PhoneCode: 93,
    Capital: 'Kabul',
    IndependenceYear: 1919
  });
});

# Query all the records where the Independence Year was less than 50 years ago:

tableName.findAll({
  where: {
    IndependenceYear: { $gt: new Date().getFullYear() - 50}
  }
});

# Query the table, order it by descending Independence Years, and limit the results to just show 2 of the records. Skipping the first two (i.e. Results: Zambia, Afghanistan)

tableName.findAll({
  offset: 2,
  limit: 2,
  order: [[sequelize.col('IndependenceYear'), 'DESC']]
})

#Use sequelize to make changes to an existing table with data in it by sequelize migrations from the command line:
 http://docs.sequelizejs.com/en/latest/docs/migrations/

 npm install --save sequelize-cli


 ## Updating Models and Migrations
 https://itnext.io/overcoming-sequelize-hiccups-24e916ebb4c4

 ## Codecast tutorial
 https://www.youtube.com/playlist?list=PL5ze0DjYv5DYBDfl0vF_VRxEu8JdTIHlR