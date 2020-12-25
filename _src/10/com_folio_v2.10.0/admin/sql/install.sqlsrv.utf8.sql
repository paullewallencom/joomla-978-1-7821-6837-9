SET QUOTED_IDENTIFIER ON;

IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[#__folio]') AND type in (N'U'))
BEGIN
CREATE TABLE [#__folio](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[title] [nvarchar](255) NOT NULL,	
	[alias] [nvarchar](255) NOT NULL,
	[catid] [int] NOT NULL,
	[state] [smallint] NOT NULL,
	[image] [nvarchar](255) NOT NULL,
	[company] [nvarchar](255) NOT NULL,
	[phone] [nvarchar](12) NOT NULL,
  	[url] [nvarchar](255) NOT NULL,
  	[description] [nvarchar](max) NOT NULL,
	[publish_up] [datetime] NOT NULL,
	[publish_down] [datetime] NOT NULL,
	[ordering] [int] NOT NULL,
	[checked_out] [int] NOT NULL DEFAULT '0',
	[checked_out_time] [datetime] NOT NULL DEFAULT '1900-01-01T00:00:00.000',
	[access] [int] NOT NULL DEFAULT '1',	
	[language] [nvarchar](7) NOT NULL DEFAULT '',
	[created] [datetime] NOT NULL DEFAULT '1900-01-01T00:00:00.000',
	[created_by] [bigint] NOT NULL DEFAULT '0',
	[created_by_alias] [nvarchar](255) NOT NULL DEFAULT '',
	[modified] [datetime] NOT NULL DEFAULT '1900-01-01T00:00:00.000',
	[modified_by] [bigint] NOT NULL DEFAULT '0',
	[metakey] [nvarchar](max) NOT NULL,
	[metadesc] [nvarchar](max) NOT NULL,
	[metadata] [nvarchar](max) NOT NULL,
	[params] [nvarchar](max) NOT NULL,
	[featured] [tinyint] NOT NULL DEFAULT '0',
 CONSTRAINT [PK_#__folio_id] PRIMARY KEY CLUSTERED
(
	[id] ASC
)WITH (STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF)
)
END;