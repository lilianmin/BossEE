define({ "api": [
  {
    "type": "param",
    "url": "http://118.25.17.80/index/Index/add_needs",
    "title": "添加用户需求",
    "name": "add_needs",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Users unique ID.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "need_name",
            "description": "<p>需求者名称-非空</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "e_mail",
            "description": "<p>用户邮箱-非空邮箱格式</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>用户电话-非空</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "company_name",
            "description": "<p>需求公司名称-非空</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "needs_desc",
            "description": "<p>需求描述-非空</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "code",
            "description": "<p>返回码</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "reason",
            "description": "<p>中文解释</p>"
          },
          {
            "group": "Success 200",
            "type": "String[]",
            "optional": false,
            "field": "data",
            "description": "<p>返回数据</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n     \"code\":0,\n     \"reason\":\"需求已经提交了，我们的工作人员会在2个工作日内和您取得联系!\",\n     \"data\":[]\n }",
          "type": "json"
        }
      ]
    },
    "filename": "./application/index/controller/Index.php",
    "group": "D__Study_brophp_WWW_application_index_controller_Index_php",
    "groupTitle": "D__Study_brophp_WWW_application_index_controller_Index_php"
  },
  {
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "varname1",
            "description": "<p>No type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "varname2",
            "description": "<p>With type.</p>"
          }
        ]
      }
    },
    "type": "",
    "url": "",
    "version": "0.0.0",
    "filename": "./application/index/controller/doc/main.js",
    "group": "D__Study_brophp_WWW_application_index_controller_doc_main_js",
    "groupTitle": "D__Study_brophp_WWW_application_index_controller_doc_main_js",
    "name": ""
  },
  {
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "varname1",
            "description": "<p>No type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "varname2",
            "description": "<p>With type.</p>"
          }
        ]
      }
    },
    "type": "",
    "url": "",
    "version": "0.0.0",
    "filename": "./public/doc/main.js",
    "group": "D__Study_brophp_WWW_public_doc_main_js",
    "groupTitle": "D__Study_brophp_WWW_public_doc_main_js",
    "name": ""
  }
] });
